<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meter_id',
        'reading_date',
        'reading_value',
        'employee_id',
        'reading_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'reading_date' => 'date',
        'reading_value' => 'decimal:2',
        'reading_type' => 'string',
    ];

    /**
     * Get the meter associated with the meter reading.
     */
    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }

    /**
     * Get the employee associated with the meter reading (if any).
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function lastReading()
    {
        
    }
}
