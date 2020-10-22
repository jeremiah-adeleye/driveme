<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hireVehicleRequest extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function vehicle() {
        return $this->belongsTo('App\AllTransaction');
    }
}
