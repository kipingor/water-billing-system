<?php

namespace App\Utilities;

use App\Models\Bill;
use App\Models\Tax;

class TaxCalculator
{
    /**
     * Calculate the total tax amount for a given bill.
     *
     * @param  \App\Models\Bill  $bill
     * @return float
     */
    public static function calculateTaxAmount(Bill $bill)
    {
        $totalTaxAmount = 0;

        foreach ($bill->taxes as $tax) {
            $taxAmount = self::calculateIndividualTaxAmount($bill->amount, $tax->rate, $tax->is_compound);
            $totalTaxAmount += $taxAmount;
        }

        return $totalTaxAmount;
    }

    /**
     * Calculate the individual tax amount for a given amount and tax rate.
     *
     * @param  float  $amount
     * @param  float  $taxRate
     * @param  bool  $isCompound
     * @return float
     */
    protected static function calculateIndividualTaxAmount($amount, $taxRate, $isCompound)
    {
        if ($isCompound) {
            // Compound tax calculation logic
            $taxAmount = $amount * ($taxRate / (1 + $taxRate));
        } else {
            // Simple tax calculation logic
            $taxAmount = $amount * $taxRate;
        }

        return $taxAmount;
    }

    /**
     * Calculate the tax based on the income.
     *
     * @param float $income
     * @return float
     */
    public function calculateIndividualTax(float $income): float
    {
        // Tax bands and rates based on KRA
        // Source: https://www.kra.go.ke/individual/filing-paying/types-of-taxes/individual-income-tax
        $tax = 0.0;
        if ($income <= 24000) {
            $tax = $income * 0.10;
        } elseif ($income <= 32333) {
            $tax = 2400 + (($income - 24000) * 0.25);
        } else {
            $tax = 4475.75 + (($income - 32333) * 0.30);
        }
        return $tax;
    }

    /**
     * Calculate the corporation tax based on the income and expenses.
     *
     * @param float $income
     * @param float $expenses
     * @return float
     */
    public function calculateCorporationTax(float $income, float $expenses): float
    {
        // Corporation tax is 30% of taxable income (income - expenses)
        // Source: https://kra.go.ke/news-center/public-notices/1042-change-of-tax-rates
        $taxableIncome = $income - $expenses;
        $tax = $taxableIncome * 0.30;
        return $tax;
    }
}