<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasPayments;
use App\Traits\HasTaxes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Barryvdh\DomPDF\Facade\Pdf;

class Bill extends Model
{
    use HasFactory, HasPayments, HasTaxes, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meter_id',
        'billing_period',
        'due_date',
        'amount',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'due_date' => 'date:d-m-Y',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the customer associated with the bill.
     */
    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }
    

    /**
     * Get the payments associated with the bill.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function pdf()
    {
        $customer = $this->meter->customer;
        $meter = $this->meter;
        $pdf = Pdf::loadView('pdf.bill', compact('bill', 'meter', 'customer'));

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
