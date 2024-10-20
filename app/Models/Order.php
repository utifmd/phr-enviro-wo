<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Order
 *
 * @property $id
 * @property $path
 * @property $unit
 * @property $description
 * @property $req_qty
 * @property $rem_qty
 * @property $sch_qty
 * @property $uom
 * @property $required_date
 * @property $pick_up_from
 * @property $destination
 * @property $wr_number
 * @property $rig_name
 * @property $pic
 * @property $change
 * @property $post_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Order extends Model
{
    use HasFactory;

    protected $keyType = 'integer';

    public $incrementing = true;

    protected $table = 'orders';

    protected $fillable = [
        'status', 'description', 'req_qty', 'rem_qty', 'sch_qty', 'uom', 'required_date', 'pick_up_from', 'destination', 'wr_number', 'rig_name', 'pic', 'change', 'post_id', 'yard', 'trip'
    ];
    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
    const ROUTE_POS = 2;

    const ROUTE_NAME = 'orders';
}
