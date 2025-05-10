<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Address;
use App\Models\Store;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::with(['user', 'address'])->paginate(10);
        return view('superadmin.pages.data-master.store', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', Password::default(), 'confirmed'],
                'address' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'district' => 'required|string|max:255',
                'post_code' => 'required|string|max:20',
                'delivery_instructions' => 'nullable|string|max:500',
                'store_name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'owner_name' => 'nullable|string|max:255',
                'store_email' => 'nullable|string|email|max:255|unique:stores,email,NULL,id,deleted_at,NULL',
                'store_phone_number' => 'nullable|string|max:20|unique:stores,phone_number',
                'business_type' => 'nullable|string|max:255',
                'status' => 'required|boolean',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $superAdmin = Auth::user();  // Mendapatkan data superadmin yang sedang login

            // Membuat User baru (akun pemilik toko)
            $user = User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'role_id' => 2,  // 2 adalah role untuk UMKM
                'password' => Hash::make($validatedData['password']),
            ]);

            // Membuat Alamat baru
            $address = Address::create([
                'user_id' => $user->id,  // Set user_id untuk relasi dengan User
                'address' => $validatedData['address'],
                'province' => $validatedData['province'],
                'city' => $validatedData['city'],
                'district' => $validatedData['district'],
                'post_code' => $validatedData['post_code'],
                'delivery_instructions' => $validatedData['delivery_instructions'],
            ]);

            // Membuat Store baru
            // Menyimpan logo (jika ada)
            $logoPath = null;
            if ($request->hasFile('logo')) {
                // Simpan logo ke folder "logos" di dalam public storage
                $logoPath = $request->file('logo')->store('logos', 'public');
                // Hanya simpan nama file saja di database, tanpa path lengkap
                $logoPath = basename($logoPath);
            }

            $store = Store::create([
                'store_name' => $validatedData['store_name'],
                'description' => $validatedData['description'],
                'owner_name' => $validatedData['owner_name'],
                'email' => $validatedData['store_email'],
                'phone_number' => $validatedData['store_phone_number'],
                'business_type' => $validatedData['business_type'],
                'status' => $validatedData['status'],
                'logo' => $logoPath,
                'created_by' => $superAdmin->id,  // Menyimpan ID superadmin yang membuat store
                'user_id' => $user->id,  // Relasi ke user (pemilik toko)
                'address_id' => $address->id,  // Relasi ke alamat
            ]);

            return redirect()->route('superadmin.data-master.umkm.index')->with('success', 'Store created successfully.');
        } catch (Exception $e) {
            Log::error('Failed to create store: ' . $e->getMessage());
            return redirect()->route('superadmin.data-master.umkm.index')->with('error', 'Failed to create store: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Cari user berdasarkan ID
            $store = Store::findOrFail($id);
            $user = $store->user; // Mengambil store yang terkait dengan user

            // Validasi data
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id], // Ignore current user for unique validation
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'phone_number' => ['required', 'string', 'max:255', 'unique:users,phone_number,' . $user->id],
                'password' => ['nullable', 'string', Password::default(), 'confirmed'],
                'address' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'district' => 'required|string|max:255',
                'post_code' => 'required|string|max:20',
                'delivery_instructions' => 'nullable|string|max:500',
                'store_name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'owner_name' => 'nullable|string|max:255',
                'store_email' => 'nullable|string|email|max:255|unique:stores,email,' . $store->id . ',id,deleted_at,NULL', // Ignore current store and consider soft deletes
                'store_phone_number' => 'nullable|string|max:20|unique:stores,phone_number,' . $store->id, // Ignore current store
                'business_type' => 'nullable|string|max:255',
                'status' => 'required|boolean',
            ]);

            $superAdmin = Auth::user();  // Mendapatkan data superadmin yang sedang login

            // Update data User
            $user->update([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'role_id' => 2,  // 2 adalah role untuk UMKM
                'password' => $request->password ? Hash::make($validatedData['password']) : $user->password,
            ]);

            // Update data Address
            $address = $store->address;
            $address->update([
                'address' => $validatedData['address'],
                'province' => $validatedData['province'],
                'city' => $validatedData['city'],
                'district' => $validatedData['district'],
                'post_code' => $validatedData['post_code'],
                'delivery_instructions' => $validatedData['delivery_instructions'],
            ]);

            // Jika ada logo baru diunggah, simpan file logo baru
            if ($request->hasFile('logo')) {
                // Hapus logo lama jika ada
                if ($store->logo) {
                    Storage::disk('public')->delete('logos/' . $store->logo);
                }

                // Simpan logo baru
                $logoPath = $request->file('logo')->store('logos', 'public');
                $logoPath = basename($logoPath);
                $store->logo = $logoPath;
            }

            // Update data Store
            $store->update([
                'store_name' => $validatedData['store_name'],
                'description' => $validatedData['description'],
                'owner_name' => $validatedData['owner_name'],
                'email' => $validatedData['store_email'],
                'phone_number' => $validatedData['store_phone_number'],
                'business_type' => $validatedData['business_type'],
                'status' => $validatedData['status'],
                'created_by' => $superAdmin->id,
                'address_id' => $address->id,
            ]);

            return redirect()->route('superadmin.data-master.umkm.index')->with('success', 'Store updated successfully.');
        } catch (Exception $e) {
            Log::error('Failed to update store: ' . $e->getMessage());
            return redirect()->route('superadmin.data-master.umkm.index')->with('error', 'Failed to update store: ' . $e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Cari store berdasarkan ID
            $store = Store::findOrFail($id);

            // Cari user yang terkait dengan store tersebut
            $user = $store->user;

            // Hapus logo dari penyimpanan jika ada
            if ($store->logo) {
                Storage::disk('public')->delete('logos/' . $store->logo);
            }

            // Cek jika ada alamat yang terkait dengan user, maka hapus alamat tersebut
            $address = $user->address;
            if ($address) {
                $address->delete();
            }

            // Hapus store setelah semua relasi sudah diproses
            $store->delete();

            // Hapus user setelah store dan address sudah dihapus
            $user->delete();

            return redirect()->route('superadmin.data-master.umkm.index')->with('success', 'User and related store deleted successfully.');
        } catch (Exception $e) {
            Log::error('Failed to delete user and related store: ' . $e->getMessage());
            return redirect()->route('superadmin.data-master.umkm.index')->with('error', 'Failed to delete user and related store: ' . $e->getMessage());
        }
    }

    // /**
    //  * Validate the store data.
    //  */
    // protected function validateStore(Request $request, $storeId = null)
    // {
    //     $uniqueEmailRule = 'nullable|email|unique:stores,email' . ($storeId ? ',' . $storeId : '');
    //     $uniquePhoneRule = 'nullable|string|unique:stores,phone_number' . ($storeId ? ',' . $storeId : '');

    //     $request->validate([
    //         'store_name' => 'required|string|max:255',
    //         'description' => 'required|string|max:255',
    //         'owner_name' => 'nullable|string|max:255',
    //         'address_id' => 'required|exists:addresses,id',
    //         'email' => $uniqueEmailRule,
    //         'phone_number' => $uniquePhoneRule,
    //         'business_type' => 'nullable|string|max:100',
    //         'status' => 'boolean',
    //         'logo' => 'nullable|string|max:2048',
    //     ]);
    // }
}
