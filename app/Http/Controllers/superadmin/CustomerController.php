<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

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
        $this->validateCustomer($request);

        try {
            User::create($request->all());
            return redirect()->route('superadmin.data-master.customer.index')->with('success', 'Customer created successfully.');
        } catch (Exception $e) {
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
    public function update(Request $request, User $customer)
    {
        $this->validateCustomer($request, $customer->id);

        try {
            $customer->update($request->all());
            return redirect()->route('superadmin.data-master.customer.index')->with('success', 'Customer updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('superadmin.data-master.customer.index')->with('error', 'Failed to update customer: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $customer)
    {
        try {
            $customer->delete();
            return redirect()->route('superadmin.data-master.customer.index')->with('success', 'Customer deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('superadmin.data-master.customer.index')->with('error', 'Failed to delete customer: ' . $e->getMessage());
        }
    }

    /**
     * Validate the customer data.
     */
    protected function validateCustomer(Request $request, $customerId = null)
    {
        $uniqueEmailRule = 'nullable|email|unique:users,email' . ($customerId ? ',' . $customerId : '');
        $uniquePhoneRule = 'nullable|string|unique:users,phone_number' . ($customerId ? ',' . $customerId : '');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => $uniqueEmailRule,
            'phone_number' => $uniquePhoneRule,
            'role_id' => 'required|exists:roles,id',
            'status' => 'boolean',
        ]);
    }
}
