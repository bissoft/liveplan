<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroTrailBalance extends Model
{
    protected $fillable = [
        'ReportID',
        'ReportName',
        'ReportType',
        'ReportTitles',
        'ReportDate',
        'UpdatedDateUTC',
        'Rows'
    ];
    public static $chars = [
        'ReportID',
        'ReportName',
        'ReportType',
        'ReportTitles',
        'ReportDate',
        'UpdatedDateUTC',
        'Rows'
    ];
    public $timestamps = false;
}
