<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Total Customer
        $totalCustomer = User::where('role_id', 1)->count();

        // Total UMKM
        $totalUMKM = Store::count();

        // Total Kategori
        $totalKategori = Category::count();

        // Total Produk
        $totalProduk = Product::count();

        // Get Top 10 Customer Highest Order
        $topCustomers = Order::select('user_id', DB::raw('count(*) as total_orders'))
            ->groupBy('user_id')
            ->orderBy('total_orders', 'desc')
            ->take(10)
            ->with('user')
            ->get();

        foreach ($topCustomers as $order) {
            $order->name = $order->user->name;
            $order->total = $order->total_orders;
        }

        // dd($topCustomers);

        // Get Top 10 Customer Highest Priced Order
        $topPricedOrders = Order::select('user_id', DB::raw('sum(total) as total_spent'))
            ->groupBy('user_id')
            ->orderBy('total_spent', 'desc')
            ->take(10)
            ->with('user')
            ->get();

        foreach ($topPricedOrders as $order) {
            $order->name = $order->user->name;
        }
        // dd($topPricedOrders);



        // Get Top 10 UMKM Highest Order
        $topUMKMs = Order::select('stores.store_name', DB::raw('count(orders.id) as total_orders'))
            ->join('order_details', 'orders.code_order', '=', 'order_details.code_order')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->groupBy('stores.store_name')
            ->orderBy('total_orders', 'desc')
            ->take(10)
            ->get();

        foreach ($topUMKMs as $order) {
            $order->store = $order->store_name;
        }
        // dd($topUMKMs);



        // Get Top 10 UMKM Highest Income
        $topIncomeUMKMs = Order::select('stores.store_name', DB::raw('sum(order_details.price * order_details.quantity) as total_income'))
            ->join('order_details', 'orders.code_order', '=', 'order_details.code_order')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->groupBy('stores.store_name')
            ->orderBy('total_income', 'desc')
            ->take(10)
            ->get();
            foreach ($topIncomeUMKMs as $store) {
                $store->store = $store->store_name;
            }

        // $topIncomeUMKMs = $topIncomeUMKMs->map(function ($store) {
        //     return [
        //     'store_name' => $store->store_name,
        //     'total_income' => $store->total_income,
        //     ];
        // });

        // foreach ($topIncomeUMKMs as $order) {
        //     $order->store = $order->store_name;

        // }
        // dd($topIncomeUMKMs->pluck(['total_income']));


        return view('superadmin.pages.dashboard', compact('totalCustomer', 'totalUMKM', 'totalKategori', 'totalProduk', 'topCustomers', 'topPricedOrders', 'topUMKMs', 'topIncomeUMKMs'));
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
