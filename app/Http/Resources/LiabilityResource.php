<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LiabilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'description' => $this->description,
            'type' => $this->type,
            'amount' => $this->amount,
            'start_date' => $this->start_date,
            'due_date' => $this->due_date,
            'interest_rate' => $this->interest_rate,
            'payment_frequency' => $this->payment_frequency,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
