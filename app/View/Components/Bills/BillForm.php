<?php

namespace App\View\Components\Bills;

use Closure;
use App\Models\Meter;
use App\Models\Bill;
use App\Http\Resources\BillResource;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BillForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct
    (
        public Bill $bill
    )
    { }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bills.bill-form', [
            'meters' => Meter::where('meter_status', 'active')->with('customer')->get(),
        ]);
    }
}
