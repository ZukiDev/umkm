<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::user();  // Get the currently logged-in admin

        // Get the store associated with the admin
        $store = Store::where('user_id', $admin->id)->firstOrFail();

        // Get orders associated with the store from order details
        $orders = $store->products()
            ->with('orderDetails.order')
            ->get()
            ->pluck('orderDetails')
            ->flatten()
            ->pluck('order')
            ->unique();

        $orders = $orders->whereNotIn('status', [3, 4]);

        return view('admin.pages.order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $admin = Auth::user(); // Mendapatkan admin yang sedang login

        // Mendapatkan toko yang terhubung dengan admin
        $store = Store::where('user_id', $admin->id)->firstOrFail();

        // Ambil ID order dari request
        $id = $request->query('id');

        // Mendapatkan orders yang terkait dengan store
        $order = $store->products()
            ->with('orderDetails.order')
            ->get()
            ->pluck('orderDetails')
            ->flatten()
            ->pluck('order')
            ->unique()
            ->firstWhere('id', $id); // Cari order berdasarkan ID

        // Cek apakah order ditemukan
        if (!$order) {
            return redirect()->back()->withErrors(['Order tidak ditemukan.']);
        }

        // Ambil code order yang akan dikirim ke pelanggan
        $orderCode = $order->code_order;

        // Ambil nomor telepon pelanggan dari data order
        $customerPhoneNumber = $order->user->phone_number;

        // Membuat pesan untuk WhatsApp
        $whatsappMessage = "Halo, ini dari E-Commerce UMKM Blitar.\n\nKami ingin mengonfirmasi pesanan Anda dengan code:\n$orderCode\n\nMohon beri tahu kami jika Anda memiliki pertanyaan lebih lanjut.";

        // Redirect to WhatsApp with the message
        $whatsappUrl = "https://wa.me/$customerPhoneNumber?text=" . urlencode($whatsappMessage);

        return redirect()->away($whatsappUrl);
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
    public function update(Request $request, Order $order) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
