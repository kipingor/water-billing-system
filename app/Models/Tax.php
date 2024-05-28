<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'rate',
        'description',
        'is_compound',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'rate' => 'decimal:4',
        'is_compound' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the bill tax records associated with the tax.
     */
    public function billTaxes()
    {
        return $this->hasMany(BillTax::class);
    }
}
