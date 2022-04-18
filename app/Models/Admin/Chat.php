<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user1_id', 'user2_id'
    ];

    public function user1()
    {
        return $this->belongsTo('App\User', 'user1_id');
    }

    public function user2()
    {
        return $this->belongsTo('App\User', 'user2_id');
    }
    
    public function messages()
    {
        return $this->hasMany('App\Models\Admin\Message', 'chat_id');
    }
    
    public function last_msg()
    {
        return $this->hasOne('App\Models\Admin\Message', 'chat_id')->latest();
    }
}
