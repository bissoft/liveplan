<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroBankTransfer extends Model
{
    //
    protected $fillable = [
        'FromBankAccount',
        'ToBankAccount',
        'Amount',
        'Date',
        'BankTransferID',
        'CurrencyRate',
        'FromBankTransactionID',
        'ToBankTransactionID',
        'FromIsReconciled',
        'ToIsReconciled',
        'Reference',
        'HasAttachments',
        'CreatedDateUTC',
    ];
    public static $chars = [
        'FromBankAccount',
        'ToBankAccount',
        'Amount',
        'Date',
        'BankTransferID',
        'CurrencyRate',
        'FromBankTransactionID',
        'ToBankTransactionID',
        'FromIsReconciled',
        'ToIsReconciled',
        'Reference',
        'HasAttachments',
        'CreatedDateUTC',
    ];
    public $timestamps = false;
}
