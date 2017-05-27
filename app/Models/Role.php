<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use App\Models\User;

class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
}
