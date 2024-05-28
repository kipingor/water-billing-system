<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'idnumber' => $this->idnumber,
            'department' => $this->department,
            'job_title' => $this->job_title,
            'hire_date' => $this->hire_date,
            'salary' => $this->salary,
            'employment_status' => $this->employment_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'expenses' => ExpenseResource::collection($this->whenLoaded('expenses')),
            'meterReadings' => MeterReadingResource::collection($this->whenLoaded('meterReadings')),
            'payrolls' => PayrollResource::collection($this->whenLoaded('payrolls')),
            'reports' => ReportResource::collection($this->whenLoaded('reports')),
        ];
    }
}