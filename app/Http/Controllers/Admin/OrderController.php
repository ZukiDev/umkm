<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
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
            ->unique()
            ->filter(function ($order) {
                return !in_array($order->status, [3, 4]); // Hanya ambil pesanan yang belum selesai atau batal
            });
            
       

        // Fetch order details for each order
        $orders->each(function ($order) {
            $order->orderDetails = OrderDetail::where('code_order', $order->code_order)->get();
            $order->payment      = Payment::where('order_id', $order->id)->get('payment_method');
        });

        // Get Belum Bayar
        $unpaidCount = $store->products()
            ->with('orderDetails.order')
            ->get()
            ->pluck('orderDetails')
            ->flatten()
            ->pluck('order')
            ->unique()
            ->filter(function ($order) {
                return in_array($order->status, [0]); // Only take orders that are not completed or canceled
            })->count();

            // dd($unpaidCount);

        // Get Proses
        // Get Proses
        $processCount = $store->products()
            ->with('orderDetails.order')
            ->get()
            ->pluck('orderDetails')
            ->flatten()
            ->pluck('order')
            ->unique()
            ->filter(function ($order) {
                return in_array($order->status, [1]); // Only take orders that are not completed or canceled
            })->count();

        // Get On Delivery
        $onDeliveryCount = $store->products()
            ->with('orderDetails.order')
            ->get()
            ->pluck('orderDetails')
            ->flatten()
            ->pluck('order')
            ->unique()
            ->filter(function ($order) {
                return in_array($order->status, [2]); // Only take orders that are not completed or canceled
            })->count();


        return view('admin.pages.order', compact('orders', 'unpaidCount', 'processCount', 'onDeliveryCount'));
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
    public function update(Request $request, Order $order) {
        // Validate the request
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3,4', // Assuming status can be 0 to 4
        ]);

        // Update the order status
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.order.index')->with('success', 'Order status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
