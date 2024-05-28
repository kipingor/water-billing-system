<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Events\BillCreatedEvent;
use App\Models\Meter;
use App\Models\MeterReading;
use App\Models\BillingContact;
use App\Services\BillingService;
use App\Services\PaymentService;
use App\Http\Resources\BillResource;
use App\Notifications\BillNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class BillController extends Controller
{
    protected $paymentService;

    protected $billingService;

    public function __construct(PaymentService $paymentService, BillingService $billingService)
    {
        $this->paymentService = $paymentService;
        $this->billingService = $billingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('bills.index');
        $bills = Bill::with('payments', 'meter')->get();
        return BillResource::collection($bills);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillRequest $request)
    {
        DB::beginTransaction();
        try {
            $meterReading = new MeterReading([
                'meter_id' => $request->input('meter_id'),
                'reading_value' => $request->input('reading_value'),
                'reading_date' => $request->input('reading_date') ?? now()->startOfMonth()->addDays(config('billing.reading_end_date') - 1),
                'employee_id' => auth()->id(),
            ]);            

            if (!$meterReading->save()) {
                throw new \Exception('Failed to save meter reading');
            }

            $bill = $this->billingService->generateBill($request->validated());
            if (!$bill) {
                throw new \Exception('Failed to generate bill');
            }
    
            DB::commit();

            BillCreatedEvent::dispatch($bill);
            return response()->json(['message' => 'Bills generated successfully']);
            // return new BillResource($bill);
            

            // Redirect back to the same page
            

            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in BillController@store: ' . $e->getMessage());
            return response()->json(['error' => 'Error processing request: ' . $e->getMessage()], 500);
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        $bill->load('meter', 'payments');        
        
        return view('bills.show', [
            'bill' => new BillResource($bill),
        ]);

       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $bill->update($request->validated());
        return new BillResource($bill);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return response()->noContent();
    }

    public function createBill(StoreBillRequest $request)
    {
        // Add the meter reading
        $meterReading = MeterReading::create([
            'meter_id' => $request->input('meter_id'),
            'reading_date' => $request->input('reading_date') ?? now(),
            'reading_value' => $request->input('reading_value'),
            'reading_type' => 'manual', // Assuming manual entry
            'employee_id' => auth()->id(),
        ]);

        // $meterReading = new MeterReading([
        //     'meter_id' => $request->input('meter_id'),
        //     'reading_value' => $request->input('reading_value'),
        //     'reading_date' => $request->input('reading_date') ?? now(),
        //     'employee_id' => auth()->id(),
        //     'reading_type' => 'manual', // Assuming manual entry
        // ]);

        // Generate the bill
        $bill = $this->billingService->generateBill($request->validated());

        return response()->json(['message' => 'Bill created successfully', 'bill' => $bill]);
    }
}
