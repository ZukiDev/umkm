<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.pages.product', compact('products'));
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
        // Check if the user is authenticated
        // if (!auth()->check()) {
        //     return redirect()->route('login')->with('error', 'You need to be logged in.');
        // }

        // $userId = auth()->id(); // Now it should work
        // $store = Store::where('user_id', $userId)->first();

        // if (!$store) {
        //     return redirect()->back()->with('error', 'No store found for the authenticated user.');
        // }

        // // Ensure that a user is authenticated
        // if (!$userId) {
        //     return redirect()->back()->with('error', 'User is not authenticated.');
        // }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'weight' => 'nullable|numeric',
            'dimensions' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);

        // Handle file upload
        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('product-images', 'public');
        }

        // Create the new product
        Product::create([
            'store_id' => 1, // Store ID from the store related to the user
            'name' => $request->name,
            'description' => $request->description,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
            'brand' => $request->brand,
            'status' => $request->status,
            'images' => $imagePath ?? null,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
