<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Payment;

class PaymentReceivedNotification extends Notification
{
    use Queueable;

    public $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $customer = $this->payment->bill->customer;
        $amount = $this->payment->amount;
        $paymentDate = $this->payment->payment_date->format('Y-m-d');
        $paymentMethod = $this->payment->payment_method;

        return (new MailMessage)
            ->greeting('Hello ' . $customer->first_name . ' ' . $customer->last_name)
            ->line('Thank you for your payment towards your water bill.')
            ->line('Payment Amount: ' . $amount)
            ->line('Payment Date: ' . $paymentDate)
            ->line('Payment Method: ' . $paymentMethod)
            ->line('Your payment has been received and processed successfully.')
            ->line('Thank you for your cooperation!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
