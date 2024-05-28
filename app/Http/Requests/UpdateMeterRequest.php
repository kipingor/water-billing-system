<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMeterRequest extends FormRequest
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
        $meter = $this->route('meter');

        return [
            'customer_id' => 'required|exists:customers,id',
            'meter_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('meters')->ignore($meter->id),
            ],
            'location' => 'required|string|max:255',
            'meter_type' => 'required|string|in:analog,digital',
            'meter_status' => 'required|string|in:active,inactive,replaced',
            'installation_date' => 'required|date',
        ];
    }
}
