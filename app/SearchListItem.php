<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchListItem extends Model
{
    protected $table = 'list_items';

    protected $fillable = [
        'list_id', 'account_id', 'company_id'
    ];
}
