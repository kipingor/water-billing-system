<?php

namespace App\Services;

use App\Models\Bill;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillNotification;

class PDFService
{
    /**
     * Generate a PDF for the given bill.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Barryvdh\DomPDF\PDF
     */
    public function generateBillPDF(Bill $bill)
    {
        $customer = $bill->customer;
        $pdf = Pdf::loadView('pdf.bill', compact('bill', 'customer'));

        return $pdf;
    }

    /**
     * Send the bill PDF via email.
     *
     * @param  \App\Models\Bill  $bill
     * @param  string  $email
     * @return void
     */
    public function sendBillPDFEmail(Bill $bill, $email)
    {
        $pdf = $this->generateBillPDF($bill);
        $pdf->attachData($pdf->output(), 'bill.pdf');
        Mail::to($email)->send(new BillNotification($bill))->attach($pdf);
    }
}