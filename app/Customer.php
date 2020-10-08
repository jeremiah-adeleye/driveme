<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Customer
 *
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $car_make
 * @property string $car_model
 * @property string $address
 * @property string $working_hour
 * @property string $occupation
 * @property string $insurance_policy
 * @property string $preferred_driving_city
 * @property string $driver_class_type
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCarMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCarModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDriverClassType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereInsurancePolicy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePreferredDrivingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereWorkingHour($value)
 */
class Customer extends Model{

    protected $fillable = [
        'car_make', 'car_model', 'address', 'working_hour', 'occupation', 'insurance_policy', 'preferred_driving_city', 'driver_class_type'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
