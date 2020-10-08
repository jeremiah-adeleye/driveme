<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporate extends Model{

    protected $fillable = [
        'name', 'address', 'registration_number'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
