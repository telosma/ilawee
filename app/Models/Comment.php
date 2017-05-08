<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Post};
use Carbon\Carbon;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('l jS F Y');
    }
}
