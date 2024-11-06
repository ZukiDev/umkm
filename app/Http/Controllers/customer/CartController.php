<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        // Calculate the sub total payment
        $subTotalPayment = $carts->sum(function ($cart) {
            return $cart->price * $cart->quantity;
        });

        // Define the PPN percentage
        $ppnPercentage = 10; // 10%

        // Calculate the PPN
        $ppn = ($subTotalPayment * $ppnPercentage) / 100;

        // Calculate the total payment including PPN
        $totalPayment = $subTotalPayment + $ppn;

        return view('customer.pages.cart', compact('carts', 'subTotalPayment', 'ppn', 'totalPayment'));
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

        if ($request->checkout) {
            return $this->directCheckout($request, $user);
        } else {
            return $this->addToCart($request, $user);
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
        $request->validate(['quantity' => 'required|integer|min:1']);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'You must be logged in to update the cart.'], 403);
        }

        DB::beginTransaction();
        try {
            $product = Product::lockForUpdate()->findOrFail($cart->product_id);

            // Check if the requested quantity is available in stock
            $availableStock = $product->stock + $cart->quantity;
            if ($availableStock < $request->quantity) {
                DB::rollBack();
                return response()->json(['error' => 'The requested quantity is not available in stock.'], 400);
            }

            // Update the cart item
            $product->stock += $cart->quantity; // Revert the stock to the original state
            $cart->quantity = $request->quantity;
            $cart->total = $cart->price * $cart->quantity;
            $cart->save();

            // Update the product stock
            $product->stock = $availableStock - $request->quantity;
            $product->save();

            // Calculate totals
            $subTotalPayment = Cart::where('user_id', $user->id)->sum('total');
            $ppn = $subTotalPayment * 0.1;
            $totalPayment = $subTotalPayment + $ppn;

            DB::commit();

            return response()->json([
                'success' => true,
                'subTotalPayment' => number_format($subTotalPayment, 0, ',', '.'),
                'ppn' => number_format($ppn, 0, ',', '.'),
                'totalPayment' => number_format($totalPayment, 0, ',', '.'),
                'itemTotal' => number_format($cart->total, 0, ',', '.')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating cart: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the cart.'], 500);
        }
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
            Log::error('Error removing product from cart: ' . $e->getMessage());
            return redirect()->route('customer.cart.index')->with('error', 'An error occurred while removing the product from the cart.');
        }

        return redirect()->back()->with('success', 'Product successfully removed from the cart.');
    }

    private function directCheckout(Request $request, $user)
    {
        DB::beginTransaction();
        try {
            $product = Product::lockForUpdate()->findOrFail($request->id_product);

            if ($product->stock < $request->quantity) {
                DB::rollBack();
                return redirect()->route('customer.cart.index')->with('error', 'The requested quantity is not available in stock.');
            }

            // Clear the user's cart and restock products
            $this->clearCart($user);

            // Add the new product for direct checkout
            $this->createCartItem($user, $product, $request->quantity);

            // Update product stock
            $product->stock -= $request->quantity;
            $product->save();

            DB::commit();
            return redirect()->route('customer.order.create')->with('success', 'Product successfully added to the cart and ready for checkout.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during single product checkout: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while checking out the product.');
        }
    }

    private function addToCart(Request $request, $user)
    {
        DB::beginTransaction();
        try {
            $product = Product::lockForUpdate()->findOrFail($request->id_product);

            if ($product->stock < $request->quantity) {
                DB::rollBack();
                return redirect()->route('customer.cart.index')->with('error', 'The requested quantity is not available in stock.');
            }

            // Check for different store items in the cart
            if ($this->hasDifferentStoreItems($user, $product)) {
                DB::rollBack();
                return redirect()->route('customer.cart.index')->with('warning', 'Your cart contains items from a different store. Please clear your cart before adding items from a new store.');
            }

            $existingCartItem = Cart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCartItem) {
                // Update quantity if already in cart
                $newQuantity = $existingCartItem->quantity + $request->quantity;
                if ($product->stock < $newQuantity) {
                    DB::rollBack();
                    return redirect()->route('customer.cart.index')->with('warning', 'The requested quantity exceeds the available stock.');
                }
                $existingCartItem->quantity = $newQuantity;
                $existingCartItem->total = $existingCartItem->price * $newQuantity;
                $existingCartItem->save();
            } else {
                // Add new product to cart
                $this->createCartItem($user, $product, $request->quantity);
            }

            $product->stock -= $request->quantity;
            $product->save();

            DB::commit();
            return redirect()->back()->with('success', 'Product successfully added to the cart.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error adding product to cart: ' . $e->getMessage());
            return redirect()->route('customer.cart.index')->with('error', 'An error occurred while adding the product to the cart.');
        }
    }

    private function clearCart($user)
    {
        $existingCarts = Cart::where('user_id', $user->id)->get();
        foreach ($existingCarts as $existingCart) {
            $product = Product::lockForUpdate()->findOrFail($existingCart->product_id);
            $product->stock += $existingCart->quantity;
            $product->save();
        }
        Cart::where('user_id', $user->id)->delete();
    }

    private function createCartItem($user, $product, $quantity)
    {
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->product_id = $product->id;
        $cart->quantity = $quantity;
        $cart->price = $product->price;
        $cart->total = $product->price * $quantity;
        $cart->save();
    }

    private function hasDifferentStoreItems($user, $product)
    {
        $existingCartItem = Cart::where('user_id', $user->id)->first();
        return $existingCartItem && $existingCartItem->product->store_id !== $product->store_id;
    }

}
