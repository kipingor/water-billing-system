<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Bill;
use App\Models\Payment;
use App\Services\PDFService;
use App\Services\SMSService;
use App\Models\BillingContact;
use App\Mail\BillNotification;
use App\Mail\PaymentReceivedNotification;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    protected $smsService;
    protected $pdfService;

    public function __construct(SMSService $smsService, PDFService $pdfService)
    {
        $this->smsService = $smsService;
        $this->pdfService = $pdfService;
    }

    /**
     * Send bill notification to a billing contact.
     *
     * @param  \App\Models\BillingContact  $billingContact
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function sendBillNotification(BillingContact $billingContact, Bill $bill)
    {
        // Send bill notification via email, SMS, or other preferred method
        if ($billingContact->email) {
            $this->pdfService->sendBillPDFEmail($bill, $billingContact->email);
            $billingContact->notify(new BillNotification($bill));
        }

        if ($billingContact->phone) {
            $message = "New bill issued for meter {$bill->meter->meter_number} with amount {$bill->amount}. Due date: {$bill->due_date}";
            $this->smsService->sendSMS($billingContact->phone, $message);
        }

        return response()->json(['message' => 'Bill notification sent successfully']);
    }

    /**
     * Send payment confirmation to a billing contact.
     *
     * @param  \App\Models\BillingContact  $billingContact
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function sendPaymentConfirmation(BillingContact $billingContact, Payment $payment)
    {
        // Send payment confirmation via email, SMS, or other preferred method
        if ($billingContact->email) {
            $billingContact->notify(new PaymentReceivedNotification($payment));
        }

        if ($billingContact->phone) {
            $message = "Payment of {$payment->amount} received for meter {$payment->bill->meter->meter_number}. Thank you!";
            $this->smsService->sendSMS($billingContact->phone, $message);
        }

        return response()->json(['message' => 'Payment confirmation sent successfully']);
    }

    /**
     * Send a notification to a customer.
     *
     * @param  array  $data
     * @return \App\Models\Notification
     */
    public function sendNotification(array $data)
    {
        $customer = Customer::findOrFail($data['customer_id']);

        $notification = $customer->notifications()->create([
            'type' => $data['type'],
            'message' => $data['message'],
            'channel' => $data['channel'],
        ]);

        switch ($data['channel']) {
            case 'email':
                Mail::raw($data['message'], function ($message) use ($customer, $data) {
                    $message->to($customer->email)
                        ->subject($data['type']);
                });
                break;
            case 'sms':
                // Send SMS using a third-party service
                break;
            case 'push':
                // Send push notification using a service like Firebase Cloud Messaging
                break;
        }

        $notification->update(['sent_at' => now()]);

        return $notification;
    }
}