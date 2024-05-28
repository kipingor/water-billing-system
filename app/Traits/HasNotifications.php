<?php

namespace App\Traits;

use App\Models\Notification;

trait HasNotifications
{
    /**
     * Get the notifications associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Create a new notification for the model.
     *
     * @param  array  $data
     * @return \App\Models\Notification
     */
    public function createNotification(array $data)
    {
        return $this->notifications()->create($data);
    }
}