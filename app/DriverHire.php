<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverHire extends Model
{
    protected $fillable = [
        'driver_id', 'user_id', 'type', 'start_date', 'end_date', 'reference'
    ];

    public function driver() {
        return $this->belongsTo('App\Driver');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
