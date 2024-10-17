<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TripPlan
 *
 * @property $id
 * @property $start_from
 * @property $finish_to
 * @property $trip_type
 * @property $actual_start
 * @property $actual_finish
 * @property $km_start
 * @property $km_end
 * @property $km_actual
 * @property $km_contract
 * @property $start_working_date
 * @property $end_working_date
 * @property $total_standby_hour
 * @property $total_working_hour
 * @property $post_id
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TripPlan extends Model
{
    use HasFactory;

    protected $keyType = 'integer';

    public $incrementing = true;

    protected $table = 'trip_plans';

    protected $fillable = [
        'start_from', 'finish_to', 'trip_type', 'actual_start', 'actual_finish', 'km_start', 'km_end', 'km_actual', 'km_contract', 'start_working_date', 'end_working_date', 'total_standby_hour', 'total_working_hour', 'job_ticket_number', 'post_id'
    ];
    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
    const ROUTE_POS = 3;

    const ROUTE_NAME = 'trip-plans';
}
