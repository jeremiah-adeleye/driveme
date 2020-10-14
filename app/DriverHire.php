<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DriverHire
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $type
 * @property int $user_id
 * @property string $start_date
 * @property string|null $end_date
 * @property int $approved
 * @property string $reference
 * @property string $active
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Driver[] $drivers
 * @property-read int|null $drivers_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire query()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHire whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DriverHireDrivers[] $driverHire
 * @property-read int|null $driver_hire_count
 */
class DriverHire extends Model
{
    protected $fillable = [
        'user_id', 'type', 'start_date', 'end_date', 'reference'
    ];

    public function drivers() {
        return $this->belongsToMany('App\Driver', 'driver_hire_drivers');
    }

    public function driverHire() {
        return $this->hasMany('App\DriverHireDrivers');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
