<?php

namespace App\Listeners;

use App\Events\PayrollCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PayrollCreatedListener
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
    public function handle(PayrollCreatedEvent $event): void
    {
        // Handle actions after a payroll is created
        // For example, send a notification to the employee
    }
}
