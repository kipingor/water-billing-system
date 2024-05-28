<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $customer = $this->route('customer');

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('customers')->ignore($customer->id),
            ],
            'phone_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('customers')->ignore($customer->id),
            ],
            'idnumber' => [
                'string',
                'max:20',
                Rule::unique('customers')->ignore($customer->id),
            ],
            'physical_address' => 'required|string|max:255',
            'postal_address' => 'required|string|max:255',            
            'account_status' => 'required|string|in:active,inactive,suspended',
        ];
    }
}
