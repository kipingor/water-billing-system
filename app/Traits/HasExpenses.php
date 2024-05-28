<?php

namespace App\Traits;

use App\Models\Expense;

trait HasExpenses
{
    /**
     * Get the expenses associated with the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Create a new expense for the model.
     *
     * @param  array  $data
     * @return \App\Models\Expense
     */
    public function createExpense(array $data)
    {
        return $this->expenses()->create($data);
    }
}