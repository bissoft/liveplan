<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XeroAccount extends Model
{
    protected $fillable = [
        'Code',
        'Name',
        'BankAccountNumber',
        'Status',
        'Description',
        'BankAccountType',
        'CurrencyCode',
        'TaxType',
        'AccountID',
        'OrganizationID',
        'Class',
        'SystemAccount',
        'ReportingCode',
        'ReportingCodeName'
    ];
}
