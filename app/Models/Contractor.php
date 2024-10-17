<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contractor
 *
 * @property $id
 * @property $name
 * @property $prefix_name
 * @property $suffix_name
 * @property // $user_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Contractor extends Model
{
    use HasFactory;

    protected $table = 'contractors';

    protected $keyType = 'integer';

    public $incrementing = true;

    protected $fillable = [
        'id', 'name', 'prefix_name', 'suffix_name'
    ];
}
