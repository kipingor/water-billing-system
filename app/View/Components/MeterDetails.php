<?php

namespace App\View\Components;

use App\Models\Meter;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MeterDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Meter $meter
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meter-details');
    }
}
