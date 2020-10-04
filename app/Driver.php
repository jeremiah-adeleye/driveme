<?php

namespace App;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Driver
 *
 * @property int $id
 * @property string $dob
 * @property string $location
 * @property string $salary_range
 * @property string $address
 * @property string $licence_number
 * @property int $experience
 * @property string $vehicle_type
 * @property string|null $cv
 * @property string|null $passport
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 * @method static Builder|Driver newModelQuery()
 * @method static Builder|Driver newQuery()
 * @method static Builder|Driver query()
 * @method static Builder|Driver whereAddress($value)
 * @method static Builder|Driver whereCreatedAt($value)
 * @method static Builder|Driver whereCv($value)
 * @method static Builder|Driver whereDob($value)
 * @method static Builder|Driver whereExperience($value)
 * @method static Builder|Driver whereId($value)
 * @method static Builder|Driver whereLicenceNumber($value)
 * @method static Builder|Driver whereLocation($value)
 * @method static Builder|Driver wherePassport($value)
 * @method static Builder|Driver whereSalaryRange($value)
 * @method static Builder|Driver whereUpdatedAt($value)
 * @method static Builder|Driver whereUserId($value)
 * @method static Builder|Driver whereVehicleType($value)
 * @mixin Builder
 * @property int $approval_status
 * @method static Builder|Driver whereApprovalStatus($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ApprovalRejectionMessage[] $rejectionMessages
 * @property-read int|null $rejection_messages_count
 * @property string $state
 * @property-read \App\Guarantor|null $guarantor
 * @method static Builder|Driver whereState($value)
 */
class Driver extends Model
{

    protected $fillable = [
        'dob', 'state', 'salary_range', 'address', 'licence_number', 'experience', 'vehicle_type', 'cv', 'passport', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function rejectionMessages() {
        return $this->hasMany('App\ApprovalRejectionMessage');
    }

    public function guarantor() {
        return $this->hasOne('App\Guarantor');
    }

    public function hires() {
        return $this->belongsToMany('App\DriverHire', 'driver_hire_drivers');
    }
}
