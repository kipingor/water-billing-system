<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Billing Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration values related to billing and water
    | consumption charges.
    |
    */

    'rate_per_cubic_meter' => env('BILLING_RATE_PER_CUBIC_METER', 300.0),
    'tax_rate' => env('BILLING_TAX_RATE', 0.16),
    'minimum_billing_amount' => env('BILLING_MINIMUM_AMOUNT', 300),
    'billing_cycle' => env('BILLING_CYCLE', 'monthly'),
    'due_days' => env('BILLING_DUE_DAYS', 15),

    'reading_start_date' => env('BILLING_START_DATE',27), // Start date for reading
    'reading_end_date' => env('BILLING_END_DATE',27), // End date for reading
];