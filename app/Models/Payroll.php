<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'pay_period_start',
        'pay_period_end',
        'base_salary',
        'overtime_pay',
        'bonuses',
        'deductions',
        'net_pay',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'pay_period_start' => 'datetime',
        'pay_period_end' => 'datetime',
        'base_salary' => 'decimal:2',
        'overtime_pay' => 'decimal:2',
        'bonuses' => 'decimal:2',
        'deductions' => 'decimal:2',
        'net_pay' => 'decimal:2',
        'status' => 'string',
    ];

    /**
     * Get the employee associated with the payroll record.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
