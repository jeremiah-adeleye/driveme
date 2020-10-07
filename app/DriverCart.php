<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DriverCart
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $driver_id
 * @property-read \App\Driver $driver
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|DriverCart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverCart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverCart query()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverCart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverCart whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverCart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverCart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverCart whereUserId($value)
 * @mixin \Eloquent
 */
class DriverCart extends Model{

    protected $fillable = [
        'user_id', 'driver_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function driver() {
        return $this->belongsTo('App\Driver');
    }
}
