<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'desc',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }
}
