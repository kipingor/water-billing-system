<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Meter;
use App\Utilities\BillCalculator;
use Carbon\Carbon;
use App\Services\SMSService;
use App\Services\PDFService;
use App\Services\NotificationService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class BillingService
{
    /**
     * The SMS Service instance.
     *
     * @var App\Services\SMSService
     */
    protected $smsService;
    /**
     * The PDF Service instance.
     *
     * @var App\Services\PDFService
     */
    protected $pdfService;

    /**
     * The Notofocation Service instance.
     *
     * @var App\Services\NotificationService
     */
    protected $notificationService;

    public function __construct(SMSService $smsService, PDFService $pdfService, NotificationService $notificationService)
    {
        $this->smsService = $smsService;
        $this->pdfService = $pdfService;
        $this->notificationService = $notificationService;
    }

    /**
     * Generate a new bill for the given customer.
     *
     * @param  array  $data
     * @return \App\Models\Bill
     */
    public function generateBill(array $data)
    {
        try {
            $billingCycle = Config::get('billing.billing_cycle');
            $meter = Meter::findOrFail($data['meter_id']);
            $dueDays = Config::get('billing.due_days');
            $dueDate = now()->addDays($dueDays);
            $unpaidBills = Bill::where('meter_id', $data['meter_id'])->where('status', ['due','partially paid','overdue'])->get();

            $totalConsumption = 0;

            // foreach ($meters as $meter) {
            //     $meterReadings = $meter->meterReadings()
            //         ->whereBetween('reading_date', $billingPeriod)
            //         ->orderBy('reading_date')
            //         ->get();

            //     $consumption = BillCalculator::calculateConsumption($meterReadings);
            //     $totalConsumption += $consumption;
            // }

            if ($meter) {
                $billingCycle = Config::get('billing.billing_cycle');
                $billAmount = BillCalculator::calculateBillAmount($meter);                
                $bill = Bill::create([
                    'meter_id' => $meter->id,
                    'billing_period' => $this->getBillingPeriod($billingCycle),
                    'due_date' => $dueDate,
                    'amount' => $billAmount,
                    'status' => 'due',
                ]);
                return $bill;
            } else {
                // Handle the case where no meter is found
                throw new Exception("No meter found with ID:" . $meter->id);
            }          

           
        } catch (Exception $e) {
            Log::error('Error generating bill', [
                'exception' => $e->getMessage(),
                'meter_id' => $data['meter_id'],
            ]);

            throw $e; // You can choose to re-throw the exception or handle it differently
        }
    }

    /**
     * Generate bills for all meters.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateBills()
    {
        $meters = Meter::with('billingContacts')->get();
        $billingCycle = Config::get('billing.billing_cycle');
        $dueDays = Config::get('billing.due_days');

        foreach ($meters as $meter) {
            // Calculate bill amount for the meter
            $billAmount = BillCalculator::calculateBillAmount($meter->id);

            // Create a new bill record
            $bill = Bill::create([
                'meter_id' => $meter->id,
                'billing_period' => $this->getBillingPeriod($billingCycle),
                'due_date' => now()->addDays($dueDays),
                'amount' => $billAmount,
                'status' => 'due',
            ]);

            // Send the bill to associated billing contacts
            foreach ($meter->billingContacts as $billingContact) {
                $this->notificationService->sendBillNotification($billingContact, $bill);
            }
        }

        return response()->json(['message' => 'Bills generated successfully']);
    }

    /**
     * Get the billing period start and end dates based on the input.
     *
     * @param  string  $billingPeriod
     * @return array
     */
    protected function getBillingPeriod($billingCycle): string
    {
        $startDate = now()->startOfMonth()->addDays(config('billing.reading_start_date') - 1);    
        $endDate = now()->startOfMonth()->addDays(config('billing.reading_end_date') - 1);

        // Logic to determine the billing period start and end dates based on the input
        // For example: $billingPeriod = 'May 2023'

        if ($billingCycle === 'monthly')
        {
            return $startDate->format('Y-m-d') . ' to ' . $endDate->format('Y-m-d');
        }

        else if ($billingCycle === 'yearly')
        {
            $startDate = now()->startOfYear();
            $endDate = now()->endOfYear(); 
            return $startDate->format('Y-m-d') . ' to ' . $endDate->format('Y-m-d');  
        }

        return $startDate . ' to ' . $endDate;
        
    }
}
