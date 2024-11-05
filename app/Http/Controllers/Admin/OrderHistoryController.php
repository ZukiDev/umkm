<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
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
        
        return view('admin.pages.order-history', compact('orders'));
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
