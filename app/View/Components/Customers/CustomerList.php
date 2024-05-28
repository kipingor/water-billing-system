<?php

namespace App\View\Components\Customers;

use App\Models\Customer;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Http\Resources\CustomerResource;
use App\Models\Bill;
use App\Models\Meter;
use App\Models\Notification;

class CustomerList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct
    (
        public Customer $customer
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $customers = Customer::all();
        return view('components.customers.customer-list', [
            'customers' => Customer::all(),
            'meters' => Meter::all(),
            'bills' => Bill::all(),
            'notifications' => Notification::all(),
        ]);
    }
}
