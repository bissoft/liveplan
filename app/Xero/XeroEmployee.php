<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroEmployee extends Model
{
    //
    protected $fillable = [
        'EmployeeID',
        'Status',
        'FirstName',
        'LastName',
        'External_Link',
    ];
    public static $chars = [
        'EmployeeID',
        'Status',
        'FirstName',
        'LastName',
        'External Link',
    ];
    public $timestamps = false;
}
