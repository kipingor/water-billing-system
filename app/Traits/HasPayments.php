<?php

namespace App\Traits;

use App\Models\Payment;

trait HasPayments
{
    /**
     * Get the payments associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Create a new payment for the model.
     *
     * @param  array  $data
     * @return \App\Models\Payment
     */
    public function createPayment(array $data)
    {
        return $this->payments()->create($data);
    }
}