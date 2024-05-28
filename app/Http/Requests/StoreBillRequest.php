<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Closure;

class StoreBillRequest extends FormRequest
{    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'meter_id' => 'required|exists:meters,id',
            'reading_value' => [
                ...$this->isPrecognitive() ? [] : ['required'], 
                'numeric',
                Rule::unique('meter_readings')->where(fn (Builder $query) => $query->where('meter_id', $this->input('meter_id'))),
                function ($attribute, $value, Closure $fail) {
                    $lastReading = \App\Models\MeterReading::where('meter_id', $this->input('meter_id'))->latest('reading_value')->first();
                    if ($lastReading && $value <= $lastReading->reading_value) {
                        $fail($attribute . ' must be greater than the last reading value.');
                    }
                },
            ]           
        ];
    }
}
