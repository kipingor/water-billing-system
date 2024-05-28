<?php

namespace App\View\Components\Bills;

use Closure;
use App\Models\Meter;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewBill extends Component
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
         // Assuming 'lastReading' is a method or relation that gets the last reading
        return view('components.bills.new-bill', [
            'meters' => Meter::with(['customer', 'lastReading'])->get()
        ]);
    }
}
