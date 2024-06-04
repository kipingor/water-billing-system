<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Meter;
use App\Models\MeterReading;
use App\Models\Bill;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MeterReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some customers
        $customers = Customer::factory()->count(50)->create();

        foreach ($customers as $customer) {
            // Each customer can have more than one meter
            $meters = Meter::factory()->count(rand(1, 3))->create([
                'customer_id' => $customer->id
            ]);

            foreach ($meters as $meter) {
                $readings = [];
                $lastReadingValue = 0; // Initialize with a base value or fetch the last reading from the database
                
                // First, generate all meter readings
                for ($month = 1; $month <= 12; $month++) {
                    // Ensure each new reading is greater than the last
                    $newReadingValue = $lastReadingValue + rand(10, 100); // Increment by a random value between 10 and 100

                    $readings[] = MeterReading::factory()->create([
                        'meter_id' => $meter->id,
                        'reading_value' => $newReadingValue, // Use the new incremented reading value
                        'reading_date' => Carbon::now()->subMonths($month)
                    ]);

                    $lastReadingValue = $newReadingValue; // Update the last reading value    

                    // Next, calculate consumption and generate bills
                    for ($i = 1; $i < count($readings); $i++) {
                        $latestReading = $readings[$i];
                        $previousReading = $readings[$i - 1];
                
                        $consumption = $latestReading->reading_value - $previousReading->reading_value;
                
                        // Generate a bill for each reading
                        $bill = Bill::factory()->create([
                            'meter_id' => $meter->id,
                            'billing_period' => Carbon::now(),
                            'due_date' => Carbon::now()->addDays($i + 15), // Adjusted month for due date
                            'amount' => $consumption * 300.00, // Example calculation
                        ]);

                        // Create a payment if the bill is paid or partially paid
                        if ($bill->status === 'paid' || $bill->status === 'partially paid') { 
                            $paymentAmount = $bill->status === 'paid' ? $bill->amount : rand(1, $bill->amount - 100);
                            $payment = Payment::factory()->create([
                                'payable_id' => $bill->id,
                                'payable_type' => get_class($bill),
                                'amount' => $paymentAmount,
                                'payment_date' => $bill->due_date->addDays(rand(1, 30)) // Payment date after the due date
                            ]);
                        }
                    }
                }            
            }
        }
    }
}
