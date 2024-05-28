<?php

namespace App\Services;

use App\Models\Bill;
use Carbon\Carbon;
use Safaricom\Mpesa\Mpesa;
use App\Services\SMSService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class PaymentService
{
    /**
     * The SMS Service instance.
     *
     * @var App\Services\SMSService
     */
    protected $smsService;

    /**
     * The M-Pesa client instance.
     *
     * @var \Lipisha\Mpesa
     */
    protected $mpesa;

    protected $notificationService;

    /**
     * Create a new PaymentService instance.
     *
     * @return void
     */
    public function __construct(SMSService $smsService, NotificationService $notificationService)
    {
        $this->mpesa = new Mpesa();
        $this->smsService = $smsService;
        $this->notificationService = $notificationService;
    }

    /**
     * Process a payment for a given bill.
     *
     * @param  array  $data
     * @return \App\Models\Payment
     */
    public function processPayment(array $data)
    {
        $bill = Bill::findOrFail($data['bill_id']);

        if ($data['payment_method'] === 'mpesa') {
            $paymentStatus = $this->processMpesaPayment($data['amount'], $data['phone_number']);

            if ($paymentStatus === 'success') {
                $payment = $bill->payments()->create([
                    'payment_date' => Carbon::now(),
                    'amount' => $data['amount'],
                    'payment_method' => $data['payment_method'],
                ]);

                $this->updateBillStatus($bill, $data['amount']);

                return $payment;
            } else {
                return 'failed';
            }
        } else {
            $payment = $bill->payments()->create([
                'payment_date' => Carbon::parse($data['payment_date']),
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'reference_number' => $data['reference_number'] ?? null,
            ]);

            $this->updateBillStatus($bill, $data['amount']);

            return $payment;
        }
    }

     /**
     * Process a payment using M-Pesa.
     *
     * @param  float  $amount
     * @param  string  $phoneNumber
     * @return string
     */
    public function processMpesaPayment($amount, $phoneNumber)
    {
        try {
            $paymentResponse = $this->mpesa->stkPush(
                $phoneNumber,
                $amount,
                config('app.name'),
                'Payment for Water Bill'
            );

            if ($paymentResponse->status === 'Success') {
                // Payment successful
                return 'success';
            } else {
                // Payment failed
                return 'failed';
            }
        } catch (\Exception $e) {
            // Handle payment processing error
            return 'failed';
        }
    }

    /**
     * Update the bill status based on the payment amount.
     *
     * @param  \App\Models\Bill  $bill
     * @param  float  $paymentAmount
     * @return void
     */
    protected function updateBillStatus(Bill $bill, float $paymentAmount)
    {
        $remainingAmount = $bill->amount - $paymentAmount;

        if ($remainingAmount <= 0) {
            $bill->update(['status' => 'paid']);
        } elseif ($remainingAmount < $bill->amount) {
            $bill->update(['status' => 'partially_paid']);
        }
    }

    /**
     * Handle payment for a bill.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handlePayment(Request $request)
    {
        $billId = $request->input('bill_id');
        $paymentAmount = $request->input('amount');
        $paymentMethod = $request->input('payment_method');

        $bill = Bill::findOrFail($billId);

        // Process payment
        $paymentStatus = $this->processPayment($paymentAmount, $paymentMethod);

        if ($paymentStatus === 'success') {
            // Update bill status and create a payment record
            $bill->status = 'paid';
            $bill->save();

            $bill->payments()->create([
                'amount' => $paymentAmount,
                'payment_method' => $paymentMethod,
                'payment_date' => now(),
            ]);

            // Send payment confirmation to billing contacts
            foreach ($bill->billingContacts as $billingContact) {
                $this->notificationService->sendPaymentConfirmation($billingContact, $bill);
            }

            return response()->json(['message' => 'Payment successful']);
        } else {
            return response()->json(['error' => 'Payment failed'], 400);
        }
    }    
}