<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'start_date',
        'end_date',
        'filters',
        'data',
        'generated_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'filters' => 'array',
        'data' => 'array',
    ];

    /**
     * Get the employee who generated the report (if any).
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'generated_by');
    }
}
