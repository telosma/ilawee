<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Field extends Model
{
    protected $table = 'fields';
    protected $fillable = [
        'name',
    ];

    public function posts()
    {
        return $this->hasMany(User::class, 'field_id');
    }
}
