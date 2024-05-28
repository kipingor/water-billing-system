<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillTax extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_id',
        'tax_id',
        'amount',
    ];

    /**
     * Get the tax associated with the bill tax record.
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    /**
     * Get the bill associated with the bill tax record.
     */
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
