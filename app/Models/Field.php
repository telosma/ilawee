<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class Field extends Model
{
    protected $table = 'fields';
    protected $fillable = [
        'name',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'field_id');
    }
}
