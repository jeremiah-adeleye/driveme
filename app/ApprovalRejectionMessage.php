<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ApprovalRejectionMessage
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $message
 * @property int $driver_id
 * @property-read \App\Driver $driver
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalRejectionMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalRejectionMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalRejectionMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalRejectionMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalRejectionMessage whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalRejectionMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalRejectionMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApprovalRejectionMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ApprovalRejectionMessage extends Model
{
    //
    public function driver() {
        return $this->belongsTo('App\Driver');
    }
}
