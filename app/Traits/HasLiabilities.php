<?php

namespace App\Traits;

use App\Models\Liability;

trait HasLiabilities
{
    /**
     * Get the liabilities associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function liabilities()
    {
        return $this->hasMany(Liability::class);
    }

    /**
     * Create a new liability for the model.
     *
     * @param  array  $data
     * @return \App\Models\Liability
     */
    public function createLiability(array $data)
    {
        return $this->liabilities()->create($data);
    }
}