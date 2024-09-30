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

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::with(['user','address'])
        ->orderBy('created_at', 'desc')
        ->get();
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
        // Validasi User (Akun)
        $validatedAccount = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ]);

        // Validasi Alamat
        $validatedAddress = $request->validate([
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'delivery_instructions' => 'nullable|string|max:500',
        ]);

        // Validasi Toko
        $validatedStore = $request->validate([
            'store_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:stores',
            'phone_number' => 'nullable|string|max:20|unique:stores',
            'business_type' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'logo' => 'nullable|string|max:2048',
        ]);

        $superAdmin = Auth::user();  // Mendapatkan data superadmin yang sedang login

        try {
            // Membuat User baru (akun pemilik toko)
            $inputAccount = $request->only(['name', 'username', 'email', 'phone_number', 'password']);
            $user = User::create([
                'name' => $inputAccount['name'],
                'username' => $inputAccount['username'],
                'email' => $inputAccount['email'],
                'phone_number' => $inputAccount['phone_number'],
                'role_id' => 2,  //  2 adalah role untuk UMKM
                'password' => Hash::make($inputAccount['password']),
            ]);

            // Membuat Alamat baru
            $inputAddress = $request->only(['address', 'province', 'city', 'district', 'post_code', 'delivery_instructions']);
            $address = Address::create([
                'user_id' => $user->id,  // Set user_id untuk relasi dengan User
                'address' => $inputAddress['address'],
                'province' => $inputAddress['province'],
                'city' => $inputAddress['city'],
                'district' => $inputAddress['district'],
                'post_code' => $inputAddress['post_code'],
                'delivery_instructions' => $inputAddress['delivery_instructions'],
            ]);

            // Membuat Store baru
            $inputStore = $request->only(['store_name', 'description', 'owner_name', 'email', 'phone_number', 'business_type', 'status', 'logo']);
            $store = Store::create([
                'store_name' => $inputStore['store_name'],
                'description' => $inputStore['description'],
                'owner_name' => $inputStore['owner_name'],
                'email' => $inputStore['email'],
                'phone_number' => $inputStore['phone_number'],
                'business_type' => $inputStore['business_type'],
                'status' => $inputStore['status'],
                'logo' => $inputStore['logo'],
                'created_by' => $superAdmin->id,  // Menyimpan ID superadmin yang membuat store
                'user_id' => $user->id,  // Relasi ke user (pemilik toko)
                'address_id' => $address->id,  // Relasi ke alamat
            ]);

            return redirect()->route('superadmin.data-master.store.index')->with('success', 'Store created successfully.');
        } catch (Exception $e) {
            return redirect()->route('superadmin.data-master.store.index')->with('error', 'Failed to create store: ' . $e->getMessage());
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
        // Cari store berdasarkan id
        $store = Store::findOrFail($id);

        // Validasi User (Akun UMKM)
        $validatedAccount = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $store->user_id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $store->user_id],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users,phone_number,' . $store->user_id],
            'password' => ['nullable', 'string', Password::default(), 'confirmed'], // Password optional untuk update
        ]);

        // Validasi Alamat
        $validatedAddress = $request->validate([
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'delivery_instructions' => 'nullable|string|max:500',
        ]);

        // Validasi UMKM
        $validatedStore = $request->validate([
            'store_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:stores,email,' . $store->id,
            'phone_number' => 'nullable|string|max:20|unique:stores,phone_number,' . $store->id,
            'business_type' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'logo' => 'nullable|string|max:2048',
        ]);

        try {
            // Update data User (Akun UMKM)
            $inputAccount = $request->only(['name', 'username', 'email', 'phone_number']);
            $user = User::findOrFail($store->user_id);
            $user->update([
                'name' => $inputAccount['name'],
                'username' => $inputAccount['username'],
                'email' => $inputAccount['email'],
                'phone_number' => $inputAccount['phone_number'],
            ]);

            // Jika password diberikan, update password
            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->input('password')),
                ]);
            }

            // Update data Address (Alamat UMKM)
            $inputAddress = $request->only(['address', 'province', 'city', 'district', 'post_code', 'delivery_instructions']);
            $address = Address::findOrFail($store->address_id);
            $address->update([
                'address' => $inputAddress['address'],
                'province' => $inputAddress['province'],
                'city' => $inputAddress['city'],
                'district' => $inputAddress['district'],
                'post_code' => $inputAddress['post_code'],
                'delivery_instructions' => $inputAddress['delivery_instructions'],
            ]);

            // Update data Store
            $inputStore = $request->only(['store_name', 'description', 'owner_name', 'email', 'phone_number', 'business_type', 'status', 'logo']);
            $store->update([
                'store_name' => $inputStore['store_name'],
                'description' => $inputStore['description'],
                'owner_name' => $inputStore['owner_name'],
                'email' => $inputStore['email'],
                'phone_number' => $inputStore['phone_number'],
                'business_type' => $inputStore['business_type'],
                'status' => $inputStore['status'],
                'logo' => $inputStore['logo'],
            ]);

            return redirect()->route('superadmin.data-master.store.index')->with('success', 'Store updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('superadmin.data-master.store.index')->with('error', 'Failed to update store: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        try {
            $store->delete();
            return redirect()->route('superadmin.data-master.store.index')->with('success', 'Store deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('superadmin.data-master.store.index')->with('error', 'Failed to delete store: ' . $e->getMessage());
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
