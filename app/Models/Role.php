<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use App\Models\User;

class Role extends EntrustRole
{
    // protected $table = 'roles';
    // protected $fillable = [
    //     'name',
    //     'display_name',
    //     'descriptiom'
    // ];

    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    // }
}
