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

        $user = Auth::user();
        $address = $user->address;

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
        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $validatedPaymentMethod['payment_method'],
            'total_price' => $subTotalPayment,
            'total_payment' => $totalPayment,
            'status' => 0, // pending
            'payment_date' => now(),
        ]);

        // Clear the user's cart
        Cart::where('user_id', $user->id)->delete();

        // Get the store phone number from the first cart item
        $storePhoneNumber = $carts->first()->product->store->phone_number;

        // Prepare the WhatsApp message
        $whatsappMessage = "Order Details:\n";
        $whatsappMessage .= "Order Code: $codeOrder\n";
        $whatsappMessage .= "Total Payment: Rp $totalPayment\n\n";
        $whatsappMessage .= "Order Items:\n";
        foreach ($orderDetails as $detail) {
            $productName = $carts->firstWhere('product_id', $detail['product_id'])->product->name;
            $whatsappMessage .= "Product Name: $productName, Quantity: {$detail['quantity']}, Price: Rp {$detail['price']}, Total: Rp {$detail['total']}\n";
        }
        $whatsappMessage .= "\nPayment Details:\n";
        $whatsappMessage .= "Payment Method: {$request->input('payment_method')}\n";
        $whatsappMessage .= "Total Price: Rp $subTotalPayment\n";
        $whatsappMessage .= "PPN: Rp $ppn\n";
        $whatsappMessage .= "Total Payment: Rp $totalPayment\n\n";
        $whatsappMessage .= "Shipping Address:\n";
        $whatsappMessage .= "Address: {$address->address}\n";
        $whatsappMessage .= "Province: {$address->province}\n";
        $whatsappMessage .= "City: {$address->city}\n";
        $whatsappMessage .= "District: {$address->district}\n";
        $whatsappMessage .= "Post Code: {$address->post_code}\n";

        // Add order date and time using Carbon
        $orderDateTime = Carbon::now()->format('l, d F Y H:i');
        $whatsappMessage .= "\nOrder Date and Time: $orderDateTime\n";

        // Redirect to WhatsApp with the message
        $whatsappUrl = "https://wa.me/$storePhoneNumber?text=" . urlencode($whatsappMessage);

        return redirect()->away($whatsappUrl)->with('success', 'Order placed successfully.');
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
        // Check if the order status is pending
        if ($order->status == 0) {
            // Update the order status to cancelled
            $order->status = 2; // 2 for cancelled
            $order->save();

            return redirect()->back()->with('success', 'Order has been cancelled successfully.');
        }

        return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
