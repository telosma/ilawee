<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Social extends Model
{
    protected $table = 'socials';
    protected $fillable = [
        'user_id',
        'provider',
        'provider_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
