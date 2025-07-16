<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::where('status', 1); // Menyaring hanya produk dengan status 1

        // Filter berdasarkan kata kunci pencarian (jika ada)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan kategori (jika ada)
        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        // Urutkan berdasarkan pilihan (jika ada)
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'popular':
                    // Mengurutkan berdasarkan total quantity di orderDetail
                    $query->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
                        ->select('products.*', DB::raw('SUM(order_details.quantity) as total_quantity'))
                        ->groupBy('products.id')
                        ->orderBy('total_quantity', 'desc');
                    break;
                case 'high_price':
                    $query->orderBy('price', 'desc');
                    break;
                case 'low_price':
                    $query->orderBy('price', 'asc');
                    break;
            }
        }

        $products = $query->get();
        $categories = Category::all();

        return view('customer.pages.all-product', compact('products', 'categories'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('orderDetails')->findOrFail($id);
        $product->sold = $product->orderDetails->sum('quantity');
        $blitarOnly = $product->is_blitar_only;

        $user = Auth::user();

        // Default: tidak bisa ditambahkan ke keranjang
        $isCanAddToCart = false;

        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus masuk untuk menambahkan item ke keranjang.');
        }

        // Cek apakah user sudah punya alamat
        if (!$user->address) {
            return redirect()->route('customer.profile')->with('error', 'Anda harus menambahkan alamat terlebih dahulu.');
        }

        $address = $user->address;

        // Jika produk hanya untuk Blitar dan alamat user bukan Blitar, flash error dan tidak bisa add to cart
        if ($blitarOnly && stripos($address->city, 'blitar') === false) {
            session()->flash('error', 'Maaf, produk ini hanya tersedia untuk pengiriman di daerah Blitar.');
            $isCanAddToCart = false;
        } else {
            // Jika lolos semua pengecekan, bisa ditambahkan ke keranjang
            $isCanAddToCart = true;
        }

        return view('customer.pages.detail-product', compact('product', 'isCanAddToCart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
    /**
     * Display a listing of the resource by filter
     */
    public function filter(Request $request)
    {
        $query = Product::where('status', 1);

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();
        $categories = Category::all();

        // Calculate sold quantity for each product
        // foreach ($products as $product) {
        //     $product->sold = $product->orderDetails->sum('quantity');
        // }

        return view('customer.pages.all-product', compact('products', 'categories'));
    }
}
