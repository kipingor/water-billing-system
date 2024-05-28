<?php

namespace App\Listeners;

use App\Events\NotificationSentEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationSentListener
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
    public function handle(NotificationSentEvent $event): void
    {
        // Handle actions after a notification is sent
        // For example, log the notification details or perform additional tasks
    }
}
