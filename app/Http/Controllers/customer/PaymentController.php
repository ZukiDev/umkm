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
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //

        $user = Auth::user();

        $order = Order::where('id', $payment->order_id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to view this page.');
        }

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $totalPayment = $order->payment->total_payment;

        $orderDetails = $order->orderDetails;

        $params = [
                'transaction_details' => [
                    'order_id' => $order->code_order,
                    'gross_amount' => (int)$totalPayment,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ],
                'items' => $orderDetails->map(function ($detail) {
                    return [
                        'id' => $detail->product->id,
                        'price' => (int)$detail->price,
                        'quantity' => (int)$detail->quantity,
                        'name' => $detail->product->name,
                    ];
                })->toArray(),
                'billing_address' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $order->address->address,
                    'city' => $order->address->city,
                    'postal_code' => $order->address->postal_code,
                    'country_code' => 'IDN',
                ],
                'shipping_address' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $order->address->address,
                    'city' => $order->address->city,
                    'postal_code' => $order->address->postal_code,
                    'country_code' => 'IDN',
                ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('customer.pages.payment', compact('snapToken', 'order', 'orderDetails', 'payment'));
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
    public function update(Request $request, Payment $payment)
    {
        // Check if the user is authenticated
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to update the order status.');
        }

        $order = Order::find($payment->order->id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $payment = $order->payment;
        if (!$payment) {
            return redirect()->back()->with('error', 'Payment not found for this order.');
        }

        // status payment 0 = pending, 1 = paid, 2 = cancelled
        // status order 0 = belum bayar, 1 = processed, 2 = pengiriman, 3 = selesai, 4 = cancelled

        $statusPayment = $request->status;
        $statusOrder = $order->status;

        if ($statusPayment == 1 && $statusOrder == 0) {
            // Update payment status to paid
            $payment->status = 1; // paid
            $payment->save();

            // Update order status to processed
            $order->status = 1; // processed
            $order->save();
        } elseif ($statusPayment == 2 && $statusOrder == 0) {
            // Update payment status to cancelled
            $payment->status = 2; // cancelled
            $payment->save();

            // Update order status to cancelled
            $order->status = 4; // cancelled
            $order->save();
        } elseif ($statusPayment == 3) {
            // status 3 = error / gagal
            $payment->status = 2; // cancelled
            $order->status = 4; // cancelled
            $payment->save();
            $order->save();
        } else {
            return redirect()->back()->with('error', 'Invalid status update.');
        }

        return redirect()->route('customer.order.index')->with('success', 'Order status updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

//     public function callback(Request $request)
// {
//     $serverKey = config('midtrans.server_key');
//     $signature = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

//     if ($signature !== $request->signature_key) {
//         return response()->json(['message' => 'Invalid signature'], 403);
//     }

//     $order = Order::where('code_order', $request->order_id)->first();

//     if (!$order) {
//         return response()->json(['message' => 'Order not found'], 404);
//     }

//     $payment = $order->payment;
//     if (!$payment) {
//         return response()->json(['message' => 'Payment not found'], 404);
//     }

//     // Tangani status Midtrans
//     switch ($request->transaction_status) {
//         case 'capture':
//         case 'settlement':
//             $payment->status = 1; // paid
//             $order->status = 1; // processed
//             break;

//         case 'cancel':
//         case 'deny':
//         case 'expire':
//             $payment->status = 2; // cancelled
//             $order->status = 4; // cancelled
//             break;

//         case 'pending':
//             $payment->status = 0; // pending
//             $order->status = 0;
//             break;
//     }

//     $payment->save();
//     $order->save();

//     return response()->json(['message' => 'Callback handled'], 200);
// }
    public function callback(Request $request)
{
    $serverKey = config('midtrans.server_key');
    $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    if ($signatureKey !== $request->signature_key) {
        return response()->json(['message' => 'Invalid signature key'], 403);
    }

    $order = Order::find($request->order_id)->first();

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    $payment = $order->payment;
    if (!$payment) {
        return response()->json(['message' => 'Payment not found'], 404);
    }

    // Tangani status Midtrans
    switch ($request->transaction_status) {
        case 'capture':
        case 'settlement':
            $payment->status = 1; // paid
            $order->status = 1; // processed
            break;

        case 'cancel':
        case 'deny':
        case 'expire':
            $payment->status = 2; // cancelled
            $order->status = 4; // cancelled
            break;

        case 'pending':
            $payment->status = 0; // pending
            $order->status = 0;
            break;
    }

    $payment->save();
    $order->save();

    return response()->json(['message' => 'Callback handled'], 200);
}

}
