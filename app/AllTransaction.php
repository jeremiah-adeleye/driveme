<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllTransaction extends Model
{
    protected $guarded = [];
    public function user() {
        return $this->belongsTo('App\User', 'email');

    }
    public function activeTraining() {
        return $this->hasOne('App\ActiveTraining');
    }
    public function hiredVehicleRequest() {
        return $this->hasOne('App\HiredVehicleRequest');
    }
}
