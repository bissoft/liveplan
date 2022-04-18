<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroTrackingCategory extends Model
{
    protected $fillable = ['Name', 'Status', 'TrackingCategoryID', 'Options'];
    public static $chars = ['Name', 'Status', 'TrackingCategoryID', 'Options'];
    public $timestamps = false;
}
