<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liability extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'type',
        'amount',
        'start_date',
        'due_date',
        'interest_rate',
        'payment_frequency',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'start_date' => 'date',
        'due_date' => 'date',
        'interest_rate' => 'decimal:4',
        'type' => 'string',
        'payment_frequency' => 'string',
        'is_active' => 'boolean',
    ];
}
