<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address1',
        'address2',
        'country_id',
        'city_id',
        'region_id',
        'zip',
        'phone',
        'contact',
        'email',
        'website',
        'category',
        'yelp_rating',
        'yelp_reviews',
        'facebook_rating',
        'facebook_reviews',
        'facebook_followers',
        'facebook',
        'twitter',
        'pinterest',
        'linkedin',
        'instagram',
        'youtube',
        'facebook_marketing',
        'adwords',
        'twitter_ads',
        'linkedin_ads',
        'employees',
        'year_established',
        'responsive',
        'web_hosting',
        'email_hosting',
        'cms',
        'marketing_auto',
        'schema',
        'open_graph',
        'latitude',
        'longitude',
        'industry_id',
        'keywords'
    ];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function industry()
    {
        return $this->belongsTo('App\Industry');
    }
}
