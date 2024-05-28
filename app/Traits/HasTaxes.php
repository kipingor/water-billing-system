<?php

namespace App\Traits;

use App\Models\Tax;

trait HasTaxes
{
    /**
     * Get the taxes associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxes()
    {
        return $this->morphToMany(Tax::class, 'taxable');
    }

    /**
     * Attach a tax to the model.
     *
     * @param  \App\Models\Tax  $tax
     * @return void
     */
    public function attachTax(Tax $tax)
    {
        $this->taxes()->attach($tax);
    }

    /**
     * Detach a tax from the model.
     *
     * @param  \App\Models\Tax  $tax
     * @return void
     */
    public function detachTax(Tax $tax)
    {
        $this->taxes()->detach($tax);
    }
}