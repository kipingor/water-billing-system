<?php

namespace App\View\Components\Customers;

use App\Models\Customer;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerForm extends Component
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
        return view('components.customers.customer-form');
    }
}
