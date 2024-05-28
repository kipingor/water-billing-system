<?php

namespace App\Traits;

use App\Models\Payroll;

trait HasPayrolls
{
    /**
     * Get the payrolls associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    /**
     * Create a new payroll for the model.
     *
     * @param  array  $data
     * @return \App\Models\Payroll
     */
    public function createPayroll(array $data)
    {
        return $this->payrolls()->create($data);
    }
}