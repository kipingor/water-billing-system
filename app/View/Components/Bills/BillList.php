<?php

namespace App\View\Components\Bills;

use Closure;
use App\Models\Bill;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BillList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() 
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bills.bill-list', [
            'bills' => Bill::with('payments')->get(),
        ]);
    }
}
