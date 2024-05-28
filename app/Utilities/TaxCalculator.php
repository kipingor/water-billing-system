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
}