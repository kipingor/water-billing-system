<?php

namespace App\View\Components\Bills;

use Illuminate\View\Component;
use App\Models\Bill;
use App\Http\Resources\BillResource;

class BillDetails extends Component
{    

    /**
     * Create a new component instance.
     *
     * @param Bill $bill
     */
    public function __construct
    (
        public Bill $bill
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Closure|string
     */
    public function render()
    {
        return view('components.bills.bill-details', [
            'bill' => $this->bill->load('meter', 'payments'),
        ]);
    }
}