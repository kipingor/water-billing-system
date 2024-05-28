<?php

namespace App\Services;

use App\Models\Expense;

class ExpenseService
{
    /**
     * Create a new expense.
     *
     * @param  array  $data
     * @return \App\Models\Expense
     */
    public function createExpense(array $data)
    {
        return Expense::create($data);
    }

    /**
     * Update an existing expense.
     *
     * @param  \App\Models\Expense  $expense
     * @param  array  $data
     * @return \App\Models\Expense
     */
    public function updateExpense(Expense $expense, array $data)
    {
        $expense->update($data);

        return $expense;
    }

    /**
     * Delete an expense.
     *
     * @param  \App\Models\Expense  $expense
     * @return void
     */
    public function deleteExpense(Expense $expense)
    {
        $expense->delete();
    }
}