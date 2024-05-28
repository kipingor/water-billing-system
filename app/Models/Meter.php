<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meter extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'meter_number',
        'location',
        'meter_type',
        'meter_status',
        'installation_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meter_type' => 'string',
        'meter_status' => 'string',
        'installation_date' => 'date',
    ];

    /**
     * Get the customer associated with the meter.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the meter readings associated with the meter.
     */
    public function meterReadings()
    {
        return $this->hasMany(MeterReading::class);
    }

    /**
     * Get the bills associated with the meter.
     */
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    /**
     * Get the billing contacts associated with the meter.
     */
    public function billingContacts()
    {
        return $this->belongsToMany(BillingContact::class, 'meter_billing_contact', 'meter_id', 'billing_contact_id');
    }

    public function lastReading()
    {
       return $this->hasOne(MeterReading::class)->latest();
    }

    /**
     * Assign a billing contact to the meter.
     *
     * @param  \App\Models\BillingContact  $billingContact
     * @return void
     */
    public function assignBillingContact(BillingContact $billingContact)
    {
        $this->billingContacts()->attach($billingContact);
    }

    /**
     * Remove a billing contact from the meter.
     *
     * @param  \App\Models\BillingContact  $billingContact
     * @return void
     */
    public function removeBillingContact(BillingContact $billingContact)
    {
        $this->billingContacts()->detach($billingContact);
    }
}
