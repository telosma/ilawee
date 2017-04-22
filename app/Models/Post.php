<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Comment};

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
