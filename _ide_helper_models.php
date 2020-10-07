<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
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
 */
	class DriverCart extends \Eloquent {}
}

