<?php

namespace App\View\Components;

use App\Models\Meter;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Http\Resources\MeterResource;

class MeterList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Meter $meter
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $metersList = Meter::with('customer')->get();
        return view('components.meter-list', [
            'meters' => MeterResource::collection($metersList),
        ]);
    }
}
