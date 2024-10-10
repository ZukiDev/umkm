<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Address;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where('role_id', 1)->get();
        return view('superadmin.pages.data-master.customer', compact('customers'));
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
            ]);

            // Membuat User baru (akun pengguna/customer)
            $user = User::create([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'role_id' => 1,  // 2 adalah role untuk pengguna/customer
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

            return redirect()->route('superadmin.data-master.customer.index')->with('success', 'Customer created successfully.');
        } catch (Exception $e) {
            Log::error('Failed to create store: ' . $e->getMessage());
            return redirect()->route('superadmin.data-master.customer.index')->with('error', 'Failed to create customer: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $customer)
    {
        try {
            // Cari user berdasarkan ID
            $user = User::findOrFail($customer);

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
            ]);

            // Update data User
            $user->update([
                'name' => $validatedData['name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'password' => $request->password ? Hash::make($validatedData['password']) : $user->password,
            ]);

            // Update data Address
            $address = Address::where('user_id', $user->id);
            $address->update([
                'address' => $validatedData['address'],
                'province' => $validatedData['province'],
                'city' => $validatedData['city'],
                'district' => $validatedData['district'],
                'post_code' => $validatedData['post_code'],
                'delivery_instructions' => $validatedData['delivery_instructions'],
            ]);

            return redirect()->route('superadmin.data-master.customer.index')->with('success', 'Customer updated successfully.');
        } catch (Exception $e) {
            Log::error('Failed to update store: ' . $e->getMessage());
            return redirect()->route('superadmin.data-master.customer.index')->with('error', 'Failed to update customer: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($customer)
    {
        try {
            $user = User::findOrFail($customer);
            $user->delete();
            return redirect()->route('superadmin.data-master.customer.index')->with('success', 'Customer deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('superadmin.data-master.customer.index')->with('error', 'Failed to delete customer: ' . $e->getMessage());
        }
    }

    /**
     * Validate the customer data.
     */
    // protected function validateCustomer(Request $request, $customerId = null)
    // {
    //     $uniqueEmailRule = 'nullable|email|unique:users,email' . ($customerId ? ',' . $customerId : '');
    //     $uniquePhoneRule = 'nullable|string|unique:users,phone_number' . ($customerId ? ',' . $customerId : '');

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => $uniqueEmailRule,
    //         'phone_number' => $uniquePhoneRule,
    //         'role_id' => 'required|exists:roles,id',
    //         'status' => 'boolean',
    //     ]);
    // }
}
