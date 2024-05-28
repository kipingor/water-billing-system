<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class Transaction extends Component
{   
    public $transactions;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $bills = Bill::orderBy('created_at', 'desc')->get()->map(function ($bill) {
            return [
                'type' => 'Bill',
                'date' => $bill->created_at->format('d-m-Y'),
                'amount' => $bill->amount,
                'id' => $bill->id
            ];
        });
    
        $payments = Payment::orderBy('payment_date', 'desc')->get()->map(function ($payment) {
            return [
                'type' => 'Payment',
                'date' => $payment->payment_date->format('d-m-Y'),
                'amount' => $payment->amount,
                'id' => $payment->bill_id // Assuming you want to link it to the bill
            ];
        });
    
        $this->transactions = $bills->concat($payments)->sortByDesc('date')->values()->all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transaction');
    }
}
