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
        $payload = $request->getContent();
        $notification = json_decode($payload);

        Log::info('Midtrans Webhook:', (array) $notification);

        if (!$notification || !isset($notification->order_id)) {
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        $order = Order::where('code_order', $notification->order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $payment = $order->payment;
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $this->updateOrderPaymentStatus($order, $payment, $notification->transaction_status);

        // Kirim pesan WhatsApp hanya jika pembayaran sukses
        if ($payment->status == 1 && $order->status == 1) {
            return $this->redirectWhatsapp($order, $payment);
        }

        return redirect()->route('customer.order.index');
    }

    private function updateOrderPaymentStatus($order, $payment, $transactionStatus)
    {
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            $payment->status = 1; // paid
            $order->status = 1; // processed
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            $payment->status = 2; // cancelled
            $order->status = 4; // cancelled
        } elseif ($transactionStatus == 'pending') {
            $payment->status = 0; // pending
            $order->status = 0;
        }
        $payment->save();
        $order->save();
    }

    private function redirectWhatsapp($order, $payment)
    {
        $orderDetails = $order->orderDetails;
        $address = $order->address;
        $paymentMethod = $payment->payment_method ?? '-';
        $subTotalPayment = $order->subtotal ?? 0;
        $ppn = $order->ppn ?? 0;
        $totalPayment = $order->total ?? 0;
        $codeOrder = $order->code_order;
        $inaTime = Carbon::now()->locale('id')->isoFormat('LLLL');

        $firstDetail = $orderDetails->first();
        $storePhoneNumber = $firstDetail && $firstDetail->product && $firstDetail->product->store
            ? $firstDetail->product->store->phone_number
            : null;

        if ($storePhoneNumber) {
            $whatsappMessage = "Order Details:\n";
            $whatsappMessage .= "Order Code: $codeOrder\n";
            $whatsappMessage .= "Total Payment: Rp $totalPayment\n\n";
            $whatsappMessage .= "Order Items:\n";
            foreach ($orderDetails as $detail) {
                $productName = $detail->product->name ?? '-';
                $whatsappMessage .= "Product Name: $productName, Quantity: {$detail->quantity}, Price: Rp {$detail->price}, Total: Rp {$detail->total}\n";
            }
            $whatsappMessage .= "\nPayment Details:\n";
            $whatsappMessage .= "Payment Method: $paymentMethod\n";
            $whatsappMessage .= "Total Price: Rp $subTotalPayment\n";
            $whatsappMessage .= "PPN: Rp $ppn\n";
            $whatsappMessage .= "Total Payment: Rp $totalPayment\n\n";
            if ($address) {
                $whatsappMessage .= "Shipping Address:\n";
                $whatsappMessage .= "Address: {$address->address}\n";
                $whatsappMessage .= "Province: {$address->province}\n";
                $whatsappMessage .= "City: {$address->city}\n";
                $whatsappMessage .= "District: {$address->district}\n";
                $whatsappMessage .= "Post Code: {$address->post_code}\n";
            }
            $whatsappMessage .= "\nOrder Date and Time: $inaTime\n";

            $whatsappUrl = "https://wa.me/$storePhoneNumber?text=" . urlencode($whatsappMessage);

            return redirect()->away($whatsappUrl)->with('success', 'Order placed successfully.');
        }

        return redirect()->route('customer.order.index');
    }
}
