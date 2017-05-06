<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Comment, Field};

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'field_id',
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

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }

    public function getByUser($id)
    {
        return Post::where('user_id', $id)->with('field')->withCount('comments')->get();
    }
}
