<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroCurrency extends Model
{
    protected $fillable = [
        'Code',
        'Description'
    ];
    public static $chars = [
        'Code',
        'Description'
    ];
    public $timestamps = false;
}
