<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeterReadingRequest extends FormRequest
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
            'reading_date' => 'required|date',
            'reading_value' => 'required|numeric|min:0',
            'employee_id' => 'nullable|exists:employees,id',
            'reading_type' => 'required|string|in:manual,automatic',
        ];
    }
}
