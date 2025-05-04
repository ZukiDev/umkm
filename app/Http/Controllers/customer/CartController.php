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
            return redirect()->route('login')->with('error', 'Anda harus masuk untuk menambahkan item ke keranjang.');
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
            return response()->json(['error' => 'Anda harus masuk untuk memperbarui keranjang.'], 403);
        }

        DB::beginTransaction();
        try {
            $product = Product::lockForUpdate()->findOrFail($cart->product_id);

            // Check if the requested quantity is available in stock
            $availableStock = $product->stock + $cart->quantity;
            if ($availableStock < $request->quantity) {
                DB::rollBack();
                return response()->json(['error' => 'Jumlah yang diminta tidak tersedia dalam stok.'], 400);
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
            Log::error('Terjadi kesalahan saat memperbarui keranjang: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui keranjang.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus masuk untuk menghapus item dari keranjang.');
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
            Log::error('Terjadi kesalahan saat menghapus produk dari keranjang: ' . $e->getMessage());
            return redirect()->route('customer.cart.index')->with('error', 'Terjadi kesalahan saat menghapus produk dari keranjang.');
        }

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    private function directCheckout(Request $request, $user)
    {
        DB::beginTransaction();
        try {
            $product = Product::lockForUpdate()->findOrFail($request->id_product);

            if ($product->stock < $request->quantity) {
                DB::rollBack();
                return redirect()->route('customer.cart.index')->with('error', 'Jumlah yang diminta tidak tersedia dalam stok.');
            }

            // Clear the user's cart and restock products
            $this->clearCart($user);

            // Add the new product for direct checkout
            $this->createCartItem($user, $product, $request->quantity);

            // Update product stock
            $product->stock -= $request->quantity;
            $product->save();

            DB::commit();
            return redirect()->route('customer.order.create')->with('success', 'Produk berhasil ditambahkan ke keranjang dan siap untuk checkout.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Terjadi kesalahan saat checkout produk tunggal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat melakukan checkout produk.');
        }
    }

    private function addToCart(Request $request, $user)
    {
        DB::beginTransaction();
        try {
            $product = Product::lockForUpdate()->findOrFail($request->id_product);

            if ($product->stock < $request->quantity) {
                DB::rollBack();
                return redirect()->route('customer.cart.index')->with('error', 'Jumlah yang diminta tidak tersedia dalam stok.');
            }

            // Check for different store items in the cart
            if ($this->hasDifferentStoreItems($user, $product)) {
                DB::rollBack();
                return redirect()->route('customer.cart.index')->with('warning', 'Keranjang Anda berisi item dari toko yang berbeda. Harap kosongkan keranjang Anda sebelum menambahkan item dari toko baru.');
            }

            $existingCartItem = Cart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCartItem) {
                // Update quantity if already in cart
                $newQuantity = $existingCartItem->quantity + $request->quantity;
                if ($product->stock < $newQuantity) {
                    DB::rollBack();
                    return redirect()->route('customer.cart.index')->with('warning', 'Jumlah yang diminta melebihi stok yang tersedia.');
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
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Terjadi kesalahan saat menambahkan produk ke keranjang: ' . $e->getMessage());
            return redirect()->route('customer.cart.index')->with('error', 'Terjadi kesalahan saat menambahkan produk ke keranjang.');}
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
