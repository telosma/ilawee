<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Role};

class UserRole extends Model
{
    protected $table = 'user_role';
}
