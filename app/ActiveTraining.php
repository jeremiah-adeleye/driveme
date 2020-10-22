<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveTraining extends Model
{
    protected $guarded = [];
    public function driverPlan()
    {       
        return $this->belongsTo('App\driving_plans')->withTimestamps();
    }
}
