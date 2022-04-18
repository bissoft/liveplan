<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroBudget extends Model
{
    protected $fillable = [
        'BudgetID',
        'Type',
        'Description',
        'UpdatedDateUTC',
        'Tracking',
        'BudgetLines',
    ];
    public static $chars = [
        'BudgetID',
        'Type',
        'Description',
        'UpdatedDateUTC',
        'Tracking',
        'BudgetLines',
    ];
    public $timestamps = false;
}
