<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroOverPayment extends Model
{
    protected $fillable = [
        'Type',
        'Contact',
        'Date',
        'Status',
        'LineAmountTypes',
        'LineItems',
        'SubTotal',
        'TotalTax',
        'Total',
        'UpdatedDateUTC',
        'CurrencyCode',
        'OverpaymentID',
        'CurrencyRate',
        'RemainingCredit',
        'Allocations',
        'Payments',
        'HasAttachments'
    ];
    public static $chars = [
        'Type',
        'Contact',
        'Date',
        'Status',
        'LineAmountTypes',
        'LineItems',
        'SubTotal',
        'TotalTax',
        'Total',
        'UpdatedDateUTC',
        'CurrencyCode',
        'OverpaymentID',
        'CurrencyRate',
        'RemainingCredit',
        'Allocations',
        'Payments',
        'HasAttachments'
    ];
    public $timestamps = false;
}
