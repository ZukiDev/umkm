<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Exception;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::all();
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
        $this->validateStore($request);

        try {
            Store::create($request->all());
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
    public function update(Request $request, Store $store)
    {
        $this->validateStore($request, $store->id);

        try {
            $store->update($request->all());
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

    /**
     * Validate the store data.
     */
    protected function validateStore(Request $request, $storeId = null)
    {
        $uniqueEmailRule = 'nullable|email|unique:stores,email' . ($storeId ? ',' . $storeId : '');
        $uniquePhoneRule = 'nullable|string|unique:stores,phone_number' . ($storeId ? ',' . $storeId : '');

        $request->validate([
            'store_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'address_id' => 'required|exists:addresses,id',
            'email' => $uniqueEmailRule,
            'phone_number' => $uniquePhoneRule,
            'business_type' => 'nullable|string|max:100',
            'status' => 'boolean',
            'logo' => 'nullable|string|max:2048',
        ]);
    }
}
