<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    public function RevenueCost()
    {
        return $this->hasMany(Revenue::class, 'revenue_id', 'id');
    }
}
