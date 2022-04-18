<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroItem extends Model
{
    protected $fillable = [
        'ItemID',
        'Code',
        'Name',
        'IsSold',
        'IsPurchased',
        'Description',
        'PurchaseDescription',
        'PurchaseDetails',
        'SalesDetails',
        'IsTrackedAsInventory',
        'InventoryAssetAccountCode',
        'TotalCostPool',
        'QuantityOnHand',
        'UpdatedDateUTC',
    ];
    public static $chars = [
        'ItemID',
        'Code',
        'Name',
        'IsSold',
        'IsPurchased',
        'Description',
        'PurchaseDescription',
        'PurchaseDetails',
        'SalesDetails',
        'IsTrackedAsInventory',
        'InventoryAssetAccountCode',
        'TotalCostPool',
        'QuantityOnHand',
        'UpdatedDateUTC',
    ];
    public $timestamps = false;
}
