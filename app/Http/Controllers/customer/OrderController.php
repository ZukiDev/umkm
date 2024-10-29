<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\Payment;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with(['orderDetails', 'payment'])->get();

        return view('customer.pages.orders', compact('orders'));
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

        return view('customer.pages.checkout', compact('carts', 'address', 'subTotalPayment', 'ppn', 'totalPayment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $address = $user->address;
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
            'payment_method' => $request->input('payment_method'),
            'total_price' => $subTotalPayment,
            'total_payment' => $totalPayment,
            'status' => 0, // pending
            'payment_date' => now(),
        ]);

        // Clear the user's cart
        Cart::where('user_id', $user->id)->delete();

        // Get the store phone number from the first cart item
        $storePhoneNumber = $carts->first()->store->phone_number;

        // Prepare the WhatsApp message
        $whatsappMessage = "Order Details:\n";
        $whatsappMessage .= "Order Code: $codeOrder\n";
        $whatsappMessage .= "Total Payment: $totalPayment\n\n";
        $whatsappMessage .= "Order Items:\n";
        foreach ($orderDetails as $detail) {
            $whatsappMessage .= "Product ID: {$detail['product_id']}, Quantity: {$detail['quantity']}, Price: {$detail['price']}, Total: {$detail['total']}\n";
        }
        $whatsappMessage .= "\nPayment Details:\n";
        $whatsappMessage .= "Payment Method: {$request->input('payment_method')}\n";
        $whatsappMessage .= "Total Price: $subTotalPayment\n";
        $whatsappMessage .= "Total Payment: $totalPayment\n";

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
