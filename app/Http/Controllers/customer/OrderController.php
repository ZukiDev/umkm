<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\Payment;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        // Proses setiap order untuk mendapatkan orderDetails dan umkm
        $orders->map(function ($order) {
            // Ambil order details berdasarkan code_order
            $orderDetails = OrderDetail::where('code_order', $order->code_order)->get();

            // Dapatkan produk pertama dari order details dan toko UMKM terkait
            $productUmkm = $orderDetails->first()->product ?? null;
            $umkm = $productUmkm ? $productUmkm->store : null;

            // Tambahkan data tambahan ke dalam order
            $order->orderDetails = $orderDetails;
            $order->umkm = $umkm;

            return $order;
        });

        return view('customer.pages.order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $address = $user->address;
        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('customer.cart.index')->with('error', 'Your cart is empty.');
        }

        // Check if the user has an address
        if (!$address) {
            return redirect()->route('customer.profile', ['tab' => 'address'])
                ->with('error', 'Please update your address before proceeding to checkout.');
        }

        // Cek apakah ada produk yang hanya bisa dikirim ke Blitar
        $blitarOnlyProduct = $carts->first(function ($cart) {
            return $cart->product && $cart->product->is_blitar_only;
        });

        // Jika ada produk khusus Blitar dan alamat user bukan Blitar, redirect dengan error
        if ($blitarOnlyProduct && stripos($address->city, 'blitar') === false) {
            return redirect()->route('customer.cart.index')
                ->with('error', 'Maaf, terdapat produk yang hanya tersedia untuk pengiriman di daerah Blitar. Silakan ubah alamat Anda atau hapus produk tersebut dari keranjang.');
        }

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

        return view('customer.pages.checkout', compact('carts', 'address', 'subTotalPayment', 'ppn', 'totalPayment', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Atur Timestamp UTC+7
        $inaTime = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

        $user = Auth::user();
        $address = $user->address;

        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $validatedAddress = $request->validate([
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'delivery_instructions' => 'nullable|string|max:500',
        ]);
        $validatedPaymentMethod = $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Update the user's address if it doesn't match the input
        if (
            $validatedAddress['address'] !== $address->address ||
            $validatedAddress['province'] !== $address->province ||
            $validatedAddress['city'] !== $address->city ||
            $validatedAddress['district'] !== $address->district ||
            $validatedAddress['post_code'] !== $address->post_code
        ) {
            $address->update($validatedAddress);
        }
        // Check if the user has an address
        if (!$address) {
            // Create a new address for the user
            $address = Address::create(array_merge($validatedAddress, ['user_id' => $user->id]));
        }

        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate the sub total payment
        $subTotalPayment = $carts->sum(fn($cart) => $cart->price * $cart->quantity);

        // Define the PPN percentage and calculate the PPN
        $ppnPercentage = 10; // 10%
        $ppn = ($subTotalPayment * $ppnPercentage) / 100;

        // Calculate the total payment including PPN
        $totalPayment = $subTotalPayment + $ppn;

        // Generate a unique order code
        $codeOrder = 'ORD-' . strtoupper(uniqid());

        // Create a new order
        $order = Order::create([
            'code_order' => $codeOrder,
            'user_id' => $user->id,
            'address_id' => $address->id,
            'total' => $totalPayment,
            'status' => 0, // pending
        ]);

        // Attach cart items to the order and create order details
        $orderDetails = $carts->map(fn($cart) => [
            'code_order' => $codeOrder,
            'product_id' => $cart->product_id,
            'quantity' => $cart->quantity,
            'price' => $cart->price,
            'total' => $cart->price * $cart->quantity,
        ])->toArray();
        OrderDetail::insert($orderDetails);

        // Create a new payment record
        $payment = Payment::create([
            'order_id' => $order->id,
            'payment_method' => $validatedPaymentMethod['payment_method'],
            'payment_date'  => $inaTime,
            'total_price' => $subTotalPayment,
            'total_payment' => $totalPayment,
            'status' => 0, // pending
            'payment_date' => now(),
        ]);

        // Clear the user's cart
        Cart::where('user_id', $user->id)->delete();

        // Redirect to the payment page with the snap token

        if ($validatedPaymentMethod['payment_method'] === 'cod') {
            // Format payment method
            $paymentMethod = $payment->payment_method === 'bank_transfer' ? 'Bank Transfer' : ($payment->payment_method === 'cod' ? 'COD' : '-');

            // Fungsi format rupiah
            $formatRupiah = function($angka) {
                return 'Rp ' . number_format($angka, 0, ',', '.');
            };

            // Get order details and store phone number
            $orderDetailsCollection = OrderDetail::where('code_order', $codeOrder)->get();
            $firstDetail = $orderDetailsCollection->first();
            $storePhoneNumber = $firstDetail && $firstDetail->product && $firstDetail->product->store
                ? $firstDetail->product->store->phone_number
                : null;

            $buyerName = $user->name ?? '-';
            $buyerPhone = $user->phone_number ?? '-';
            $formattedBuyerPhone = preg_replace('/^(0|62)?/', '62', preg_replace('/\D/', '', $buyerPhone));

            if ($storePhoneNumber) {
                $whatsappMessage = "Detail Pesanan:\n";
                $whatsappMessage .= "Kode Pesanan: $codeOrder\n";
                $whatsappMessage .= "Nama Pembeli: $buyerName\n";
                $whatsappMessage .= "Nomor HP Pembeli: $formattedBuyerPhone\n";
                $whatsappMessage .= "Total Pembayaran: " . $formatRupiah($totalPayment) . "\n\n";
                $whatsappMessage .= "Daftar Produk:\n";
                foreach ($orderDetailsCollection as $detail) {
                    $productName = $detail->product->name ?? '-';
                    $whatsappMessage .= "Nama Produk: $productName, Jumlah: {$detail->quantity}, Harga: " . $formatRupiah($detail->price) . ", Total: " . $formatRupiah($detail->total) . "\n";
                }
                $whatsappMessage .= "\nDetail Pembayaran:\n";
                $whatsappMessage .= "Metode Pembayaran: $paymentMethod\n";
                $whatsappMessage .= "Total Harga: " . $formatRupiah($subTotalPayment) . "\n";
                $whatsappMessage .= "PPN: " . $formatRupiah($ppn) . "\n";
                $whatsappMessage .= "Total Pembayaran: " . $formatRupiah($totalPayment) . "\n\n";
                if ($address) {
                    $whatsappMessage .= "Alamat Pengiriman:\n";
                    $whatsappMessage .= "Alamat: {$address->address}\n";
                    $whatsappMessage .= "Provinsi: {$address->province}\n";
                    $whatsappMessage .= "Kota: {$address->city}\n";
                    $whatsappMessage .= "Kecamatan: {$address->district}\n";
                    $whatsappMessage .= "Kode Pos: {$address->post_code}\n";
                }
                $whatsappMessage .= "\nTanggal & Waktu Pesanan: $inaTime\n";

                $whatsappUrl = "https://wa.me/$storePhoneNumber?text=" . urlencode($whatsappMessage);

                return redirect()->away($whatsappUrl)->with('success', 'Order placed successfully.');
            }
            return redirect()->route('customer.order.index');
        } else {
            return redirect()->route('customer.payment.show', ['payment' => $payment]);
        }
    }


        // return view('customer.pages.payment.snap', compact('snapToken', 'order'));

        // // Get the store phone number from the first cart item
        // $storePhoneNumber = $carts->first()->product->store->phone_number;

        // // Prepare the WhatsApp message
        // $whatsappMessage = "Order Details:\n";
        // $whatsappMessage .= "Order Code: $codeOrder\n";
        // $whatsappMessage .= "Total Payment: Rp $totalPayment\n\n";
        // $whatsappMessage .= "Order Items:\n";
        // foreach ($orderDetails as $detail) {
        //     $productName = $carts->firstWhere('product_id', $detail['product_id'])->product->name;
        //     $whatsappMessage .= "Product Name: $productName, Quantity: {$detail['quantity']}, Price: Rp {$detail['price']}, Total: Rp {$detail['total']}\n";
        // }
        // $whatsappMessage .= "\nPayment Details:\n";
        // $whatsappMessage .= "Payment Method: {$request->input('payment_method')}\n";
        // $whatsappMessage .= "Total Price: Rp $subTotalPayment\n";
        // $whatsappMessage .= "PPN: Rp $ppn\n";
        // $whatsappMessage .= "Total Payment: Rp $totalPayment\n\n";
        // $whatsappMessage .= "Shipping Address:\n";
        // $whatsappMessage .= "Address: {$address->address}\n";
        // $whatsappMessage .= "Province: {$address->province}\n";
        // $whatsappMessage .= "City: {$address->city}\n";
        // $whatsappMessage .= "District: {$address->district}\n";
        // $whatsappMessage .= "Post Code: {$address->post_code}\n";

        // // // Add order date and time using Carbon
        // // $orderDateTime = Carbon::now()->format('l, d F Y H:i');
        // $whatsappMessage .= "\nOrder Date and Time: $inaTime\n";

        // // Redirect to WhatsApp with the message
        // $whatsappUrl = "https://wa.me/$storePhoneNumber?text=" . urlencode($whatsappMessage);

        // return redirect()->away($whatsappUrl)->with('success', 'Order placed successfully.');
    // }

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
        // Validate the request
        $request->validate([
            'status' => 'required|integer|in:0,1,2,3,4', // Assuming status can be 0 to 4
        ]);

        // Update the order status
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('customer.order.index')->with('success', 'Order status updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
