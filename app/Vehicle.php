<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        "duration",
        "delivery-date",
        "delivery-time",
        "address",
        "user_id"
    ];
}
