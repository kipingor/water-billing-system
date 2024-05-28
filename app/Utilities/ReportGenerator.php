<?php

namespace App\Utilities;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Payment;
use Carbon\Carbon;

class ReportGenerator
{
    /**
     * Generate a revenue report for the given period.
     *
     * @param  string  $startDate
     * @param  string  $endDate
     * @return array
     */
    public static function generateRevenueReport($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $billPayments = Payment::whereBetween('created_at', [$startDate, $endDate])
            ->with('bill')
            ->get();

        $totalRevenue = $billPayments->sum('amount');

        $report = [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'total_revenue' => $totalRevenue,
            'payments' => $billPayments,
        ];

        return $report;
    }

    /**
     * Generate an expense report for the given period.
     *
     * @param  string  $startDate
     * @param  string  $endDate
     * @return array
     */
    public static function generateExpenseReport($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $expenses = Expense::whereBetween('expense_date', [$startDate, $endDate])
            ->get();

        $totalExpenses = $expenses->sum('amount');

        $report = [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'total_expenses' => $totalExpenses,
            'expenses' => $expenses,
        ];

        return $report;
    }

    // Additional methods for generating other types of reports
}