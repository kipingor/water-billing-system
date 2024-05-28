<?php

namespace App\Listeners;

use App\Events\ReportGeneratedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReportGeneratedListener
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
    public function handle(ReportGeneratedEvent $event): void
    {
        // Handle actions after a report is generated
        // For example, send a notification to the user or save the report to a specific location
    }
}
