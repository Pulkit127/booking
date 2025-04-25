<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError; 

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $orderData = [
            'receipt'         => 3456,
            'amount'          => $request->amount * 100,  // Amount should be in paise
            'currency'        => 'INR',
            'payment_capture' => 1
        ];

        try {
            $order = $api->order->create($orderData);
            return response()->json(['order_id' => $order->id, 'amount' => $orderData['amount']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Handle success logic, save payment details in DB, etc.
        return response()->json(['message' => 'Payment Successful']);
    }

    public function paymentFailure(Request $request)
    {
        // Handle failure logic
        return response()->json(['message' => 'Payment Failed']);
    }
}
