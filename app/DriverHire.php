<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverHire extends Model
{
    protected $fillable = [
        'user_id', 'type', 'start_date', 'end_date', 'reference'
    ];

    public function drivers() {
        return $this->belongsToMany('App\Driver', 'driver_hire_drivers');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
