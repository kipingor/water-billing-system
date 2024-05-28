<?php

namespace App\Listeners;

use App\Events\ExpenseCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExpenseCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ExpenseCreatedEvent $event): void
    {
        // Handle the event, for example: send a notification, update a report, etc.
        // Access the expense via $event->expense
    }
}
