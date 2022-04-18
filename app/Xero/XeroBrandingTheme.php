<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroBrandingTheme extends Model
{
    protected $fillable = [
        'BrandingThemeID',
        'Name',
        'LogoUrl',
        'Type',
        'SortOrder',
        'CreatedDateUTC',
    ];
    public static $chars = [
        'BrandingThemeID',
        'Name',
        'LogoUrl',
        'Type',
        'SortOrder',
        'CreatedDateUTC',
    ];
    public $timestamps = false;
}
