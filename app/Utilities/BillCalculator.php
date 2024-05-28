<?php

namespace App\Utilities;

use App\Models\Meter;
use App\Models\MeterReading;
use Illuminate\Support\Facades\Config;

class BillCalculator
{
    /**
     * Calculate the bill amount for a customer based on meter readings and rates.
     *
     * @param  \App\Models\Meter  $meter
     * @param  string  $billingPeriod
     * @return float
     */
    public static function calculateBillAmount(Meter $meter)
    {
        $totalConsumption = 0;


        // Retrieve the latest meter reading
        $latestReading = $meter->meterReadings()->latest()->first();

        // Retrieve the previous meter reading
        $previousReading = $meter->meterReadings()->latest()->skip(1)->first();

        if (!$latestReading || !$previousReading) {
            $consumption = 0; // Set consumption to 0 if meter readings are not available
        } else {
            $consumption = $latestReading->reading_value - $previousReading->reading_value;
        }

        // Apply rates and calculations to determine the bill amount based on the total consumption
        $billAmount = self::applyRates($consumption);

        // Apply tax
        // $taxRate = Config::get('billing.tax_rate');
        // $billAmount = $billAmount + ($billAmount * $taxRate);

        // Check minimum billing amount
        // $minimumBillingAmount = Config::get('billing.minimum_billing_amount');
        // $billAmount = max($billAmount, $minimumBillingAmount);

        // Apply any additional charges or discounts

        return $billAmount;
    }

    /**
     * Calculate the consumption based on meter readings.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $meterReadings
     * @return float
     */
    protected static function calculateConsumption($meterReadings)
    {
        $consumption = 0;

        if ($meterReadings->count() > 1) {
            $previousReading = null;

            foreach ($meterReadings as $reading) {
                if ($previousReading === null) {
                    $previousReading = $reading;
                    continue;
                }

                $consumption += $reading->reading_value - $previousReading->reading_value;
                $previousReading = $reading;
            }
        }

        return $consumption;
    }

    /**
     * Apply rates and calculations to determine the bill amount based on the total consumption.
     *
     * @param  float  $totalConsumption
     * @return float
     */
    protected static function applyRates($consumption)
    {
        // Implement your rate calculation logic here
        // You can use fixed rates, tiered rates, or any other calculation method
        // based on your business requirements
        $rate = Config::get('billing.rate_per_cubic_meter');

        $billAmount = $consumption * $rate; // Example: Flat rate of KES250 per unit consumed

        return $billAmount;
    }
}