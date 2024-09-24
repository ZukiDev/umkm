<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::all();
        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'address_id' => 'required|exists:addresses,id',
            'email' => 'nullable|email|unique:stores',
            'phone_number' => 'nullable|string|unique:stores',
            'business_type' => 'nullable|string|max:100',
            'status' => 'boolean',
            'logo' => 'nullable|string|max:2048',
        ]);

        $store = Store::create($request->all());

        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $request->validate([
            'store_name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'address_id' => 'sometimes|required|exists:addresses,id',
            'email' => 'sometimes|nullable|email|unique:stores,email,' . $store->id,
            'phone_number' => 'sometimes|nullable|string|unique:stores,phone_number,' . $store->id,
            'business_type' => 'sometimes|nullable|string|max:100',
            'status' => 'sometimes|boolean',
            'logo' => 'sometimes|nullable|string|max:2048',
        ]);

        $store->update($request->all());

        return redirect()->route('stores.index')->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->route('stores.index')->with('success', 'Store deleted successfully.');
    }
}
