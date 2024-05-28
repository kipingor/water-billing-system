<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                ...$this->isPrecognitive() ? [] : ['required'],
                'string',
                'email',
                'max:255',
                'unique:customers',
            ],
            'phone_number' => 'required|string|max:20|unique:customers',
            'idnumber' => 'nullable|string|max:20|unique:customers',
            'physical_address' => 'required|string|max:255',
            'postal_address' => 'required|string|max:255',
            'account_status' => 'required|string|in:active,inactive,suspended',
        ];
    }
}
