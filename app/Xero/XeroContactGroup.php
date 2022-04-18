<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroContactGroup extends Model
{
    protected $fillable = [
        'ContactGroupID',
        'Name',
        'Status'
    ];
    public static $chars = [
        'ContactGroupID',
        'Name',
        'Status'
    ];
    public $timestamps = false;
}
