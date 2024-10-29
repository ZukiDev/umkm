<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::user();  // Get the currently logged-in admin

        // Get the store associated with the admin
        $store = Store::where('user_id', $admin->id)->firstOrFail();

        // Get products associated with the store
        $products = Product::where('store_id', $store->id)->get();
        $categories = Category::all();

        return view('admin.pages.product', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.pages.create_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:255|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'weight' => 'nullable|numeric',
            'dimensions' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $admin = Auth::user();  // Get the currently logged-in admin

            // Get the store associated with the admin
            $store = Store::where('user_id', $admin->id)->firstOrFail();

            $productData = array_merge($validatedData, ['store_id' => $store->id]);

            // Save the product image if it exists
            $imagePath = null;
            if ($request->hasFile('images')) {
                // Save image to "product_images" folder in public storage
                $imagePath = $request->file('images')->store('products', 'public');
                // Only save the file name in the database, without the full path
                $imagePath = basename($imagePath);
                $productData['images'] = $imagePath;
            }

            Product::create($productData);

            return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
        } catch (Exception $e) {
            Log::error('Failed to create product: ' . $e->getMessage());
            return redirect()->route('admin.product.index')->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $product = Product::findOrFail($id);
        // return view('admin.pages.show_product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $product = Product::findOrFail($id);
        // return view('admin.pages.edit_product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'weight' => 'nullable|numeric',
            'dimensions' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $admin = Auth::user();  // Get the currently logged-in admin

            // Get the store associated with the admin
            $store = Store::where('user_id', $admin->id)->firstOrFail();

            $product = Product::findOrFail($id);

            $productData = array_merge($validatedData, ['store_id' => $store->id]);

            // Update the product image if it exists
            if ($request->hasFile('images')) {
                // Delete the old image
                if ($product->images) {
                    Storage::disk('public')->delete('products/' . $product->images);
                }

                // Save new image to "product_images" folder in public storage
                $imagePath = $request->file('images')->store('products', 'public');
                // Only save the file name in the database, without the full path
                $productData['images'] = basename($imagePath);
            }

            $product->update($productData);

            return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
        } catch (Exception $e) {
            Log::error('Failed to update product: ' . $e->getMessage());
            return redirect()->route('admin.product.index')->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $admin = Auth::user();  // Get the currently logged-in admin

            // Get the store associated with the admin
            $store = Store::where('user_id', $admin->id)->firstOrFail();

            $product = Product::where('id', $id)->where('store_id', $store->id)->firstOrFail();

            // Delete the product image if it exists
            if ($product->images) {
                Storage::disk('public')->delete('products/' . $product->images);
            }

            $product->delete();

            return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
        } catch (Exception $e) {
            Log::error('Failed to delete product: ' . $e->getMessage());
            return redirect()->route('admin.product.index')->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
