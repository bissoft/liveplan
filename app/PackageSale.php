<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageSale extends Model
{
    public function user_name()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function package_name()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
