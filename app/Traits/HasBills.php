<?php

namespace App\Traits;

use App\Models\Bill;

trait HasBills
{
    /**
     * Get the bills associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    /**
     * Create a new bill for the model.
     *
     * @param  array  $data
     * @return \App\Models\Bill
     */
    public function createBill(array $data)
    {
        return $this->bills()->create($data);
    }
}