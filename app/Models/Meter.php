<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    public function scopeSearchByCustomerName($query, $name)
    {
        return $query->whereHas('customer', function ($query) use ($name) {
            $query->where('first_name', 'like', '%' . $name . '%')
                ->orWhere('last_name', 'like', '%' . $name . '%');
        });
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
     * Get all of the meter's payments.
     */
    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
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
       return $this->hasOne(MeterReading::class)->latestOfMany();
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

    public function billPdf()
    {        
        $meter = $this->with('bills', 'customers')->get();
        $pdf = Pdf::loadView('pdf.bill', compact('meter'));

        // // Optionally, you can attach the PDF to an email
        // $pdf->attachData($pdf->output(), 'waterbill.pdf');
        // Mail::to($customer->email)->send(new BillNotification($bill, $pdf));

        // // Or, you can return the PDF for download or display
        // return $pdf->download('bill.pdf');
        // // or
        // return $pdf->stream('bill.pdf');

        return $pdf;
    }
}
