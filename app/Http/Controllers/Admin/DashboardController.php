<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::user();  // Get the currently logged-in admin

        // Get the store associated with the admin
        $store = Store::where('user_id', $admin->id)->firstOrFail();

        $products = Product::where('store_id', $store->id)->get();

        $orderDetails = OrderDetail::whereIn('product_id', $products->pluck('id'))->get();

        $orders = $orderDetails->map(function ($orderDetail) {
            return $orderDetail->order;
        })->unique();

        // Get orders associated with the store from order details
        // $orders = $store->products()
        //     ->with('orderDetails.order')
        //     ->get()
        //     ->pluck('orderDetails')
        //     ->flatten()
        //     ->pluck('order')
        //     ->unique()
        //     ->filter(function ($order) {
        //         return !in_array($order->status, [3, 4]); // Hanya ambil pesanan yang belum selesai atau batal
        //     });
        
        // Konfirmasi Pesanan dengan status 0, 1, 2
        $ordersConfirm = $orders->whereIn('status', [0, 1, 2]);
        // dd($ordersConfirm);

        // Total Jumlah Pesanan dengan status 0, 1, 2
        $ordersConfirmCount = $ordersConfirm->count();
        // dd($ordersConfirmCount);
    
        // Total Jumlah Pesanan
        $ordersCount = $orders->count();
        // dd($ordersCount);
    
        // Total Pendapatan
        $totalIncome = $orderDetails->sum('total');
        // dd($totalIncome);
    
        // Total Produk
        $totalProduct = $products->count();
        // dd($totalProduct);

        // Produk Terlaris
        $bestSellingProducts = $store->products()
            ->withCount('orderDetails')
            ->orderByDesc('order_details_count')
            ->limit(5)
            ->get();
            // dd($bestSellingProducts);

        // Calculate sold quantity for each product
        foreach ($bestSellingProducts as $product) {
            $product->sold = $product->orderDetails->sum('quantity');
        }
        return view('admin.pages.dashboard',compact('ordersConfirm','ordersConfirmCount', 'ordersCount', 'totalIncome', 'totalProduct', 'bestSellingProducts'));
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
