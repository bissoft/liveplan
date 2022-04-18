<?php

namespace App\Models\Admin\Support;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    //
    protected $fillable = ['user_id','issue','category','name'];
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
