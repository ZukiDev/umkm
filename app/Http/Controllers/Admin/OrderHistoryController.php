<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;

class OrderHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::user();

        $store = Store::where('user_id', $admin->id)->firstOrFail();

        $orders = $store->products()
            ->with(['orderDetails' => function ($query) {
            $query->whereHas('order', function ($query) {
                $query->whereIn('status', [3, 4]);
            });
            }])
            ->get()
            ->pluck('orderDetails')
            ->flatten()
            ->pluck('order')
            ->unique();

        // Fetch order details for each order
        $orders->each(function ($order) {
            $order->orderDetails = OrderDetail::where('code_order', $order->code_order)->get();
        });

        // Get Count Order Cancelled
        $countOrderCancelled = $store->products()
        ->with('orderDetails.order')
        ->get()
        ->pluck('orderDetails')
        ->flatten()
        ->pluck('order')
        ->unique()
        ->filter(function ($order) {
            return in_array($order->status, [4]); // Only take orders that are not completed or canceled
        })->count();

        // dd($countOrderCancelled);

        // Get Count Order Success
        $countOrderSuccess = $store->products()
        ->with('orderDetails.order')
        ->get()
        ->pluck('orderDetails')
        ->flatten()
        ->pluck('order')
        ->unique()
        ->filter(function ($order) {
            return in_array($order->status, [3]); // Only take orders that are not completed or canceled
        })->count();

        // dd($countOrderSuccess);

        // Get Total Pendapatan
        $products = Product::where('store_id', $store->id)->get();

        $orderDetails = OrderDetail::whereIn('product_id', $products->pluck('id'))->get();

        $orderStore = $orderDetails->map(function ($orderDetail) {
            return $orderDetail->order;
        })->filter()->unique();

        $storeIncome = Order::whereIn('code_order', $orderStore->pluck('code_order'))->where('status', 3)->sum('total');

        // dd($storeIncome);



        return view('admin.pages.order-history', compact('orders', 'countOrderCancelled', 'countOrderSuccess', 'storeIncome'));
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
