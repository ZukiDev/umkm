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
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    // public function callback(Request $request)
    // {
    //     $data = $request->all();

    // Log::info('Midtrans Callback Data:', $data);

    // return response()->json(['message' => 'Success', 'data' => $data]);
    // }

    public function callback(Request $request)
    {
    //     $notif = new \Midtrans\Notification();

    //     $transaction = $notif->transaction_status;
    //     $fraud = $notif->fraud_status;

    //     error_log("Order ID $notif->order_id: "."transaction status = $transaction, fraud staus = $fraud");

    //     $order = Order::where('id', $notif->order_id)->first();
    //     if (!$order) {
    //         return response()->json(['message' => 'Order not found'], 404);
    //     }

    //     $payment = $order->payment;
    //     if (!$payment) {
    //         return response()->json(['message' => 'Payment not found'], 404);
    //     }

    //     if ($transaction == 'capture') {
    //         if ($fraud == 'challenge') {
    //         $payment->status = 0; // challenge/pending
    //         $order->status = 0; // pending
    //         } else if ($fraud == 'accept') {
    //         $payment->status = 1; // paid
    //         $order->status = 1; // processed
    //         }
    //     } else if ($transaction == 'settlement') {
    //         $payment->status = 1; // paid
    //         $order->status = 1; // processed
    //     } else if ($transaction == 'cancel' || $transaction == 'deny' || $transaction == 'expire') {
    //         $payment->status = 2; // cancelled/failed
    //         $order->status = 4; // cancelled
    //     } else if ($transaction == 'pending') {
    //         $payment->status = 0; // pending
    //         $order->status = 0; // pending
    //     }

    //     $payment->save();
    //     $order->save();
        // $serverKey = config('midtrans.server_key');
        // $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // if ($signatureKey !== $request->signature_key) {
        //     return response()->json(['message' => 'Invalid signature key'], 403);
        // }

        $payload = $request->getContent();
        $notification = json_decode($payload);

        // Log request for debugging
        Log::info('Midtrans Webhook:', (array) $notification);

        if (!$notification || !isset($notification->order_id)) {
            return response()->json(['message' => 'Invalid notification'], 400);
        }

       $order = Order::where('code_order', $request->order_id)->first();


        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $payment = $order->payment;
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
            $payment->status = 1; // paid
            $order->status = 1; // processed
        } elseif ($request->transaction_status == 'cancel' || $request->transaction_status == 'expire') {
            $payment->status = 2; // cancelled
            $order->status = 4; // cancelled
        } elseif ($request->transaction_status == 'pending') {
            $payment->status = 0; // pending
            $order->status = 0;
        }
        $payment->save();
        $order->save();

        $payment->save();
        $order->save();

        return response()->json(['message' => 'Callback handled'], 200);
    }
}
