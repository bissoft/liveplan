<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroReport extends Model
{
    //
    protected $fillable = ['Status', 'ProviderName', 'DateTimeUTC','Reports'];
    public static $chars = ['Status', 'ProviderName', 'DateTimeUTC','Reports'];
    public $timestamps = false;
}
