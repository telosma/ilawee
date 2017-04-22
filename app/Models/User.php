<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use App\Models\{Post, Comment, Social, Role};

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_link',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function posts()
    // {
    //     return $this->hasMany(Post::class, 'user_id');
    // }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class, 'user_id');
    // }

    // public function socials()
    // {
    //     return $this->hasMany(Social::class, 'user_id');
    // }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    // }

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }
}
