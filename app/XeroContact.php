<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XeroContact extends Model
{
    protected $fillable = [
        'ContactID',
        'ContactNumber',
        'AccountNumber',
        'ContactStatus',
        'Name',
        'FirstName',
        'LastName',
        'EmailAddress',
        'SkypeUserName',
        'BankAccountDetails',
        'CompanyNumber',
        'TaxNumber',
        'AccountsReceivableTaxType',
        'AccountsPayableTaxType',
        'Addresses',
        'Phones'
    ];
}
