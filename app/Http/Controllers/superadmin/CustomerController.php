<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where('role_id', 1)->get();
        return view('superadmin.layouts.data-master.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.layouts.data-master.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateCustomer($request);

        User::create($request->all());

        return redirect()->route('superadmin.data-master.customer.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $customer)
    {
        return view('superadmin.layouts.data-master.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $customer)
    {
        return view('superadmin.layouts.data-master.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $customer)
    {
        $this->validateCustomer($request, $customer->id);

        $customer->update($request->all());

        return redirect()->route('superadmin.data-master.customer.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $customer)
    {
        $customer->delete();

        return redirect()->route('superadmin.data-master.customer.index')->with('success', 'Customer deleted successfully.');
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
