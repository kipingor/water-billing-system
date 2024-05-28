<?php

namespace App\Listeners;

use App\Events\BillCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillNotification;
use Illuminate\Support\Facades\Session;

class BillCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(BillCreatedEvent $event)
    {
        $bill = $event->bill;
        $meter = $bill->meter;        

        // Check if billing contacts exist before sending email notifications
        // if ($meter->billingContacts->count() > 0) {
        //     // Send email notification to the customer
        //     $contacts = $meter->billingContacts;
        //     foreach( $contacts as $contact ) {
        //         Mail::to($contact->email)->send(new BillNotification($bill));
        //     }
        // }

         // Check if billing contacts has a phone number before sending sms notifications

        // Additional logic, such as logging or sending notifications via other channels
    }

    /**
     * Handle the event.
     */
    public function handle(BillCreatedEvent $event): void
    {
        Session::flash('alert', [
            'message' => 'Bill created successfully!',
            'type' => 'success',
            'position' => 'top-right'
        ]);

    }
}
