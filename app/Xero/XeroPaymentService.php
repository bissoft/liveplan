<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroPaymentService extends Model
{
    protected $fillable = [
        'PaymentServiceID',
        'PaymentServiceName',
        'PaymentServiceUrl',
        'PayNowText',
        'PaymentServiceType'
    ];
    public static $chars = [
        'PaymentServiceID',
        'PaymentServiceName',
        'PaymentServiceUrl',
        'PayNowText',
        'PaymentServiceType'
    ];
    public $timestamps = false;
}
