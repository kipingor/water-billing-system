<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Bill;

class BillNotification extends Notification
{
    use Queueable;

    /**
     * The bill instance.
     *
     * @var \App\Models\Bill
     */
    protected $bill;

    /**
     * Create a new notification instance.
     */
    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
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
        $customer = $this->bill->customer;
        $amount = $this->bill->amount;
        $dueDate = $this->bill->due_date->format('Y-m-d');

        return (new MailMessage)
            ->subject('New Water Bill Issued')
            ->greeting('Hello ' . $customer->first_name . ' ' . $customer->last_name)
            ->line('A new bill has been issued for your meter for the billing period ' . $this->bill->billing_period . ' is due.')
            ->line('Amount: ' . $amount)
            ->line('Due Date: ' . $dueDate)
            ->action('View Bill', url('/bills/' . $this->bill->id))
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
