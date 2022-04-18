<?php

namespace App\Xero;

use Illuminate\Database\Eloquent\Model;

class XeroJournal extends Model
{
    protected $fillable = [
        'JournalID',
        'JournalDate',
        'JournalNumber',
        'CreatedDateUTC',
        'Reference',
        'SourceID',
        'SourceType',
        'JournalLines',
    ];
    public static $chars = [
        'JournalID',
        'JournalDate',
        'JournalNumber',
        'CreatedDateUTC',
        'Reference',
        'SourceID',
        'SourceType',
        'JournalLines',
    ];
    public $timestamps = false;
}
