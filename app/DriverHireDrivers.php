<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DriverHireDrivers
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $driver_hire_id
 * @property int $driver_id
 * @property int $approved
 * @property string $active
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers query()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers whereDriverHireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverHireDrivers whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DriverHireDrivers extends Model
{

}
