<?php

namespace App\Listeners;

use App\Events\LiabilityCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LiabilityCreatedListener
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
    public function handle(LiabilityCreatedEvent $event): void
    {
        // Handle actions after a liability is created
        // For example, update financial reports or trigger payment reminders
    }
}
