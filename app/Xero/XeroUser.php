<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroUser extends Model
{
    //
    protected $fillable = [
        'UserID',
        'EmailAddress',
        'FirstName',
        'LastName',
        'UpdatedDateUTC',
        'IsSubscriber',
        'OrganisationRole'
    ];
    public static $chars = [
        'UserID',
        'EmailAddress',
        'FirstName',
        'LastName',
        'UpdatedDateUTC',
        'IsSubscriber',
        'OrganisationRole'
    ];
    public $timestamps = false;
}
