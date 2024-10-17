<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Order
 *
 * @property $id
 * @property $operator
 * @property $vehicle_type
 * @property $police_number
 * @property $driver_name
 * @property $start_plan
 * @property $end_plan
 * @property $shift
 * @property $area
 * @property $post_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Information extends Model
{
    use HasFactory;

    protected $keyType = 'integer';

    public $incrementing = true;

    protected $table = 'information';

    protected $fillable = [
        'operator', 'vehicle_type', 'police_number', 'driver_name', 'start_plan', 'end_plan', 'shift', 'area', 'post_id'
    ];

    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
    const ROUTE_POS = 1;

    const ROUTE_NAME = 'information';
}
