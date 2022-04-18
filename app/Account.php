<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name',
        'title',
        'email',
        'phone',
        'company_id',
        'country_id'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
