<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroPurchaseOrder extends Model
{
    protected $fillable =
    [
        'Contact',
        'Date',
        'DeliveryDate',
        'LineAmountTypes',
        'PurchaseOrderNumber',
        'Reference',
        'LineItems',
        'BrandingThemeID',
        'CurrencyCode',
        'Status',
        'SentToContact',
        'DeliveryAddress',
        'AttentionTo',
        'Telephone',
        'DeliveryInstructions',
        'ExpectedArrivalDate',
        'PurchaseOrderID',
        'CurrencyRate',
        'SubTotal',
        'TotalTax',
        'Total',
        'TotalDiscount',
        'HasAttachments',
        'UpdatedDateUTC'
    ];
    public static $chars =
    [
        'Contact',
        'Date',
        'DeliveryDate',
        'LineAmountTypes',
        'PurchaseOrderNumber',
        'Reference',
        'LineItems',
        'BrandingThemeID',
        'CurrencyCode',
        'Status',
        'SentToContact',
        'DeliveryAddress',
        'AttentionTo',
        'Telephone',
        'DeliveryInstructions',
        'ExpectedArrivalDate',
        'PurchaseOrderID',
        'CurrencyRate',
        'SubTotal',
        'TotalTax',
        'Total',
        'TotalDiscount',
        'HasAttachments',
        'UpdatedDateUTC'
    ];
    public $timestamps = false;
}
