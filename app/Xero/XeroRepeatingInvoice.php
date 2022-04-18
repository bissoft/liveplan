<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroRepeatingInvoice extends Model
{
    protected $fillable = [
        'Type',
        'Contacts',
        'Schedule',
        'LineItems',
        'LineAmountTypes',
        'Reference',
        'BrandingThemeID',
        'CurrencyCode',
        'Status',
        'SubTotal',
        'TotalTax',
        'Total',
        'RepeatingInvoiceID',
        'HasAttachments'
    ];
    public static $chars = [
        'Type',
        'Contacts',
        'Schedule',
        'LineItems',
        'LineAmountTypes',
        'Reference',
        'BrandingThemeID',
        'CurrencyCode',
        'Status',
        'SubTotal',
        'TotalTax',
        'Total',
        'RepeatingInvoiceID',
        'HasAttachments'
    ];
    public $timestamps = false;
}
