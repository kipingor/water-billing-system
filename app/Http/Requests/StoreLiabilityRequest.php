<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLiabilityRequest extends FormRequest
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
            'description' => 'required|string',
            'type' => 'required|in:loan,mortgage,accounts_payable,other',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'due_date' => 'nullable|date|after:start_date',
            'interest_rate' => 'nullable|numeric|between:0,100',
            'payment_frequency' => 'nullable|in:one_time,monthly,quarterly,annually',
            'is_active' => 'required|boolean',
        ];
    }
}
