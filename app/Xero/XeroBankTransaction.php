<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroBankTransaction extends Model
{
    protected $fillable = [
        'Type',
        'Contact',
        'Lineitems',
        'BankAccount',
        'BatchPayment',
        'IsReconciled',
        'Date',
        'Reference',
        'CurrencyCode',
        'CurrencyRate',
        'Url',
        'Status',
        'LineAmountTypes',
        'SubTotal',
        'TotalTax',
        'Total',
        'BankTransactionID',
        'PrepaymentID',
        'OverpaymentID',
        'UpdatedDateUTC',
        'HasAttachments',
    ];
    public static $chars = [
        'Type',
        'Contact',
        'Lineitems',
        'BankAccount',
        'BatchPayment',
        'IsReconciled',
        'Date',
        'Reference',
        'CurrencyCode',
        'CurrencyRate',
        'Url',
        'Status',
        'LineAmountTypes',
        'SubTotal',
        'TotalTax',
        'Total',
        'BankTransactionID',
        'PrepaymentID',
        'OverpaymentID',
        'UpdatedDateUTC',
        'HasAttachments',
    ];
    public $timestamps = false;
}
