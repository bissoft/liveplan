<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XeroInvoice extends Model
{
    protected $fillable = [
        'Type',
        'Contact',
        'LineItems',
        'Date',
        'DueDate',
        'LineAmountTypes',
        'InvoiceNumber',
        'CurrencyCode',
        'Status',
        'InvoiceID'
    ];
}
