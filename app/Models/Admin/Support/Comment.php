<?php

namespace App\Models\Admin\Support;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['issue_id','user_id','support_user_id','body'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
