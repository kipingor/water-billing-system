<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeterResource extends JsonResource
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
            'customer' => $this->customer->first_name . ' ' . $this->customer->last_name,
            'meter_number' => $this->meter_number,
            'location' => $this->location,
            'meter_type' => $this->meter_type,
            'meter_status' => $this->meter_status,
            'installation_date' => $this->installation_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'meter_readings' => MeterReadingResource::collection($this->whenLoaded('meterReadings')),
        ];
    }
}
