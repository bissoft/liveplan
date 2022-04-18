<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroBatchPayment extends Model
{
    protected $fillable = [
        'Account_ID',
        'Details',
        'Narrative',
        'BatchPaymentID',
        'Date',
        'Payments',
        'Type',
        'Status',
        'TotalAmount',
        'IsReconciled',
        'UpdatedDateUTC',
        'Elements',
        'Invoice',
        'PaymentID',
        'BankAccountNumber',
        'Particulars, Code & Reference',
        'Amount',
    ];
    public static $chars = [
        'Account ID',
        'Details',
        'Narrative',
        'BatchPaymentID',
        'Date',
        'Payments',
        'Type',
        'Status',
        'TotalAmount',
        'IsReconciled',
        'UpdatedDateUTC',
        'Elements',
        'Invoice',
        'PaymentID',
        'BankAccountNumber',
        'Particulars, Code & Reference',
        'Amount',
    ];
    public $timestamps = false;
}
