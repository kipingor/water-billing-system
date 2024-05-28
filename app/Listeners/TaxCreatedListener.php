<?php

namespace App\Listeners;

use App\Events\TaxCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaxCreatedListener
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
    public function handle(TaxCreatedEvent $event): void
    {
        // Handle actions after a tax is created
        // For example, update the tax rates in a third-party service or recalculate existing bills
    }
}
