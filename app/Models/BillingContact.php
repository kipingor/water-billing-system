<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingContact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'phone',
        'role',
        'is_primary',
    ];

    /**
     * Get the customer associated with the billing contact.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the meters associated with the billing contact.
     */
    public function meters()
    {
        return $this->belongsToMany(Meter::class, 'meter_billing_contact', 'billing_contact_id', 'meter_id');
    }

    /**
     * Get the bills associated with the billing contact's meters.
     */
    public function bills()
    {
        return $this->hasManyThrough(
            Bill::class,
            Meter::class,
            'id',
            'meter_id',
            'id',
            'id'
        );
    }
}
