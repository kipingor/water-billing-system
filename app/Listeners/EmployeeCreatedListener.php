<?php

namespace App\Listeners;

use App\Events\EmployeeCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmployeeCreatedListener
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
    public function handle(EmployeeCreatedEvent $event): void
    {
        // Handle the event, for example: send a welcome email, create an initial payroll record, etc.
        // Access the employee via $event->employee
    }
}
