<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'channel_id', 'slug'];

    public function channel()
    {
        return $this->belongTo('App\Channel');
    }

    public function user()
    {
        return $this->belongTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
