<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroTaxRate extends Model
{
    //
    protected $fillable = [
        'Name',
        'TaxType',
        'TaxComponents',
        'ReportTaxType',
        'CanApplyToAssets',
        'CanApplyToEquity',
        'CanApplyToExpenses',
        'CanApplyToLiabilities',
        'CanApplyToRevenue',
        'DisplayTaxRate',
        'Rate',
        'IsCompound',
        'IsNonRecoverable',
        'EffectiveRate',
        'Status'
    ];
    public static $chars = [
        'Name',
        'TaxType',
        'TaxComponents',
        'ReportTaxType',
        'CanApplyToAssets',
        'CanApplyToEquity',
        'CanApplyToExpenses',
        'CanApplyToLiabilities',
        'CanApplyToRevenue',
        'DisplayTaxRate',
        'Rate',
        'IsCompound',
        'IsNonRecoverable',
        'EffectiveRate',
        'Status'
    ];
    public $timestamps = false;
}
