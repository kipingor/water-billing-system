<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Report;
use Carbon\Carbon;

class ReportService
{
    /**
     * Generate a revenue report for the given period.
     *
     * @param  array  $data
     * @return \App\Models\Report
     */
    public function generateRevenueReport(array $data)
    {
        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);

        $filters = [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];

        $billPayments = Bill::whereBetween('created_at', [$startDate, $endDate])
            ->with('payments')
            ->get()
            ->flatMap(function ($bill) {
                return $bill->payments;
            });

        $totalRevenue = $billPayments->sum('amount');

        $data = [
            'total_revenue' => $totalRevenue,
            'payments' => $billPayments,
        ];

        return Report::create([
            'name' => 'Revenue Report',
            'type' => 'revenue',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'filters' => $filters,
            'data' => $data,
            'generated_by' => auth()->user()->employee->id,
        ]);
    }

    // Other methods for generating different types of reports
}