<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeterReadingResource extends JsonResource
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
            'meter' => new MeterResource($this->whenLoaded('meter')),
            'reading_date' => $this->reading_date,
            'reading_value' => $this->reading_value,
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
            'reading_type' => $this->reading_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
