<?php

namespace App\Jobs;

use App\Services\BillingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateBillJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $billData;

    /**
     * Create a new job instance.
     */
    public function __construct(array $billData)
    {
        $this->billData = $billData;
    }

    /**
     * Execute the job.
     */
    public function handle(BillingService $billingService): void
    {
        // $billingService->calculateBill($this->billData);
        $billingService->generateBill($this->billData);
    }
}
