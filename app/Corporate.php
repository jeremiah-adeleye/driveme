<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Corporate
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $address
 * @property string $registration_number
 * @property int $approved
 * @property int $user_id
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate whereRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Corporate whereUserId($value)
 * @mixin \Eloquent
 */
class Corporate extends Model{

    protected $fillable = [
        'name', 'address', 'registration_number'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
