<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Hash;
use App\Models\{Post, Comment, Social, Role, Upload};
// use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    // use SoftDeletes;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_link',
        'confirmed',
        'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function socials()
    {
        return $this->hasMany(Social::class, 'user_id');
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class, 'user_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // public function docs()
    // {
    //     return $this->hasManyThrough(Document::class, Upload::class);
    // }

    // relation: roles defined in EntrustUserTrait
}
