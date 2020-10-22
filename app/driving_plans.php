<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class driving_plans extends Model
{
    protected $gaurd = [];

    public function users()
    {
       
        return $this->belongsToMany('App\User', 'user_id')->withTimestamps();
    }
    public function activePlan()
    {
       
        return $this->hasOne('App\ActiveTraining');
    }
}
