<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'idnumber' => $this->idnumber,
            'physical_address' => $this->physical_address,
            'postal_address' => $this->postal_address,
            'account_number' => $this->account_number,
            'account_status' => $this->account_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'meters' => MeterResource::collection($this->whenLoaded('meters')),
            'bills' => BillResource::collection($this->whenLoaded('bills')),
            'notifications' => NotificationResource::collection($this->whenLoaded('notifications')),
        ];
    }
}
