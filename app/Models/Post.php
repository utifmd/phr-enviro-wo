<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * Class Post
 *
 * @property $id
 * @property $title
 * @property $description
 * @property $type
 * @property //$image_urls
 * @property //$trip_plan
 * @property //$order
 * @property //$user_current_post
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Post extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $primaryKey = 'id';

    protected $table = 'posts';

    protected $fillable = [
        'title', 'description', 'type', 'user_id'
    ];
    protected $perPage = 8;

    function imageUrls(): HasMany
    {
        return $this->hasMany(
            ImageUrl::class, 'post_id', 'id'
        );
    }
    function tripPlan(): HasOne

    {
        return $this->hasOne(
            TripPlan::class, 'post_id', 'id'
        );
    }

    function orders(): HasOne
    {
        return $this->hasOne(
            Order::class, 'post_id', 'id'
        );
    }

    function userCurrentPost(): HasOne
    {
        return $this->hasOne(
            UserCurrentPost::class, 'user_id', 'id'
        );
    }

    protected static function booted(): void
    {
        self::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
    const ROUTE_POS = 0;

    const ROUTE_NAME = 'posts';
}
