<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectCost extends Model
{
    public function revenue_name()
    {
        return $this->belongsTo(Revenue::class, 'revenue_id');
    }
}
