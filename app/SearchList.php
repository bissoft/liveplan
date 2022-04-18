<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchList extends Model
{
    protected $table = 'lists';

    protected $fillable = [
        'name', 'type'
    ];
}
