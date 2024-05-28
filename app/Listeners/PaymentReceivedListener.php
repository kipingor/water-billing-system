<?php

namespace App\Listeners;

use App\Events\PaymentReceivedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceivedNotification;

class PaymentReceivedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(PaymentReceivedEvent $event)
    {
        $payment = $event->payment;
        $bill = $payment->bill;
        $customer = $bill->customer;

        // Update bill status based on payment
        $this->updateBillStatus($bill, $payment);

        // Send email notification to the customer
        Mail::to($customer->email)->send(new PaymentReceivedNotification($payment));

        // Additional logic, such as logging or sending notifications via other channels
    }

    /**
    * Update the bill status based on the payment.
    *
    * @param  \App\Models\Bill  $bill
    * @param  \App\Models\Payment  $payment
    * @return void
    */
    protected function updateBillStatus($bill, $payment)
    {
        $totalPaid = $bill->payments()->sum('amount');
        $billAmount = $bill->amount;

        if ($totalPaid >= $billAmount) {
            $bill->status = 'paid';
        } else {
            $bill->status = 'partial_paid';
        }

        $bill->save();
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentReceivedEvent $event): void
    {
        //
    }
}
