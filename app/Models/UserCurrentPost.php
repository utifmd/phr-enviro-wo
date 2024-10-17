<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class User
 *
 * @property $id
 * @property $steps
 * @property $step_at
 * @property $url
 * @property $user_id
 * @property $post_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UserCurrentPost extends Model
{
    use HasFactory;

    protected $keyType = 'integer';

    protected $primaryKey = 'id';

    protected $table = 'user_current_posts';

    protected $fillable = [
        'steps', 'step_at', 'url', 'user_id', 'post_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }*/
}
