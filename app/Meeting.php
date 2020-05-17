<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    public function meeting_groups(){
        return $this->hasMany('App\MeetingGroup');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
