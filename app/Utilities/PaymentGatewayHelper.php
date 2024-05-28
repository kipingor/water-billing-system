<?php

namespace App\Utilities;

use App\Models\Payment;
use Illuminate\Support\Facades\Http;

class PaymentGatewayHelper
{
    /**
     * Process a payment through the M-Pesa gateway.
     *
     * @param  \App\Models\Payment  $payment
     * @return bool
     */
    public static function processPaymentMpesa(Payment $payment)
    {
        // Implement your M-Pesa payment gateway integration logic here
        // You might need to use an external library or API to interact with the M-Pesa gateway

        $response = Http::post('https://mpesa-gateway.com/process-payment', [
            'amount' => $payment->amount,
            'phone_number' => '254712345678', // Example phone number
            'description' => 'Water Bill Payment',
        ]);

        if ($response->successful()) {
            // Update the payment record with the reference number or any other relevant data
            $payment->update([
                'reference_number' => $response['reference_number'],
            ]);

            return true;
        }

        return false;
    }
}