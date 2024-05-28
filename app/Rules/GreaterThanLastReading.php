<?php

namespace App\Rules;

use Closure;
use App\Models\Meter;
use Illuminate\Contracts\Validation\ValidationRule;

class GreaterThanLastReading implements ValidationRule
{
    protected $meterId;
    protected $lastReadingValue;

    public function __construct($meterId)
    {
        $this->meterId = $meterId;
        $meter = Meter::find($this->meterId);

        if ($meter) {
            $lastReading = $meter->meterReadings()->latest()->first();
            $this->lastReadingValue = $lastReading ? $lastReading->reading_value : 0;
        }
    }

    public function passes($attribute, $value)
    {
        if (!$this->meterId || $this->lastReadingValue === null) {
            return false;
        }

        return $value > $this->lastReadingValue;
    }

    public function message()
    {
        return 'The value that you have entered must be greater than the last reading.';
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // if (!$this->meterId || $this->lastReadingValue === null) {
        //     $fail('The :attribute must be uppercase.');
        // }
    }
}
