<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;

class PayrollService
{
    /**
     * Generate a new payroll record for the given employee.
     *
     * @param  array  $data
     * @return \App\Models\Payroll
     */
    public function generatePayroll(array $data)
    {
        $employee = Employee::findOrFail($data['employee_id']);

        $payPeriodStart = Carbon::parse($data['pay_period_start']);
        $payPeriodEnd = Carbon::parse($data['pay_period_end']);

        $baseSalary = $employee->salary;
        $overtimePay = $data['overtime_pay'] ?? 0;
        $bonuses = $data['bonuses'] ?? 0;
        $deductions = $data['deductions'] ?? 0;

        $netPay = $this->calculateNetPay($baseSalary, $overtimePay, $bonuses, $deductions);

        return Payroll::create([
            'employee_id' => $employee->id,
            'pay_period_start' => $payPeriodStart,
            'pay_period_end' => $payPeriodEnd,
            'base_salary' => $baseSalary,
            'overtime_pay' => $overtimePay,
            'bonuses' => $bonuses,
            'deductions' => $deductions,
            'net_pay' => $netPay,
        ]);
    }

    /**
     * Calculate the net pay for the employee.
     *
     * @param  float  $baseSalary
     * @param  float  $overtimePay
     * @param  float  $bonuses
     * @param  float  $deductions
     * @return float
     */
    protected function calculateNetPay(float $baseSalary, float $overtimePay, float $bonuses, float $deductions)
    {
        $grossPay = $baseSalary + $overtimePay + $bonuses;
        $netPay = $grossPay - $deductions;

        return $netPay;
    }
}