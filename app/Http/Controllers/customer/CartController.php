<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();
        return view('customer.pages.cart', compact('carts'));
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
        $request->validate([
            'id_product' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'checkout' => 'required|boolean',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to add items to the cart.');
        }

        // Start a database transaction
        DB::beginTransaction();
        try {
            $product = Product::lockForUpdate()->findOrFail($request->id_product);

            // Check if the requested quantity is available in stock
            if ($product->stock < $request->quantity) {
                DB::rollBack();
                return redirect()->route('customer.cart.index')->with('error', 'The requested quantity is not available in stock.');
            }

            // Check if the product is already in the cart
            $cart = Cart::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->whereNull('deleted_at')
                    ->first();

            if ($cart) {
                // Update the existing cart item
                $newQuantity = $cart->quantity + $request->quantity;
                if ($product->stock < $newQuantity) {
                    $newQuantity = $product->stock;
                    DB::rollBack();
                    return redirect()->route('customer.cart.index')->with('warning', 'The requested quantity exceeds the available stock. The quantity has been adjusted to the available stock.');
                }
                $cart->quantity = $newQuantity;
                $cart->price = $product->price;
                $cart->total = $cart->price * $cart->quantity;
                $cart->save();
            } else {
                // Create a new cart item
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;
                $cart->price = $product->price;
                $cart->total = $product->price * $request->quantity;
                $cart->save();
            }

            // Decrease the product stock
            $product->stock -= $request->quantity;
            $product->save();

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.cart.index')->with('error', 'An error occurred while adding the product to the cart.');
        }

        if ($request->checkout) {
            return redirect()->route('customer.order.index')->with('success', 'Product successfully added to the cart and ready for checkout.');
        } else {
            return redirect()->route('customer.cart.index')->with('success', 'Product successfully added to the cart.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to update the cart.');
        }

        // Start a database transaction
        DB::beginTransaction();
        try {
            $product = Product::lockForUpdate()->findOrFail($cart->product_id);

            // Check if the requested quantity is available in stock
            if ($product->stock + $cart->quantity < $request->quantity) {
                DB::rollBack();
                return redirect()->route('customer.cart.index')->with('error', 'The requested quantity is not available in stock.');
            }

            // Update the cart item
            $product->stock += $cart->quantity; // Revert the stock to the original state
            $cart->quantity = $request->quantity;
            $cart->total = $cart->price * $cart->quantity;
            $cart->save();

            // Decrease the product stock
            $product->stock -= $request->quantity;
            $product->save();

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.cart.index')->with('error', 'An error occurred while updating the cart.');
        }

        return redirect()->route('customer.cart.index')->with('success', 'Cart successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to remove items from the cart.');
        }

        // Start a database transaction
        DB::beginTransaction();
        try {
            $product = Product::lockForUpdate()->findOrFail($cart->product_id);

            // Revert the product stock
            $product->stock += $cart->quantity;
            $product->save();

            // Soft delete the cart item
            $cart->delete();

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.cart.index')->with('error', 'An error occurred while removing the product from the cart.');
        }

        return redirect()->route('customer.cart.index')->with('success', 'Product successfully removed from the cart.');
    }
}
