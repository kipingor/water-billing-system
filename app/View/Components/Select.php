<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $selected,
        public array $options,
    ) {}

    /**
     * Determine if the given option is the currently selected option.
     *
     * @param string $option
     * @return bool
     */
    public function isSelected(string $option)
    {
        return $option === $this->selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
