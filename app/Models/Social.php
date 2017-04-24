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

    public static function findOrCreate($socialUser, $provider, $userId)
    {
        $existUser = Social::where('provider_user_id', $socialUser->id)->first();
        if (!$existUser) {
            try {
                $user = Social::create([
                    'user_id' => $userId,
                    'provider' => $provider,
                    'provider_user_id' => $socialUser->id,
                ]);

                return $user;
            } catch (Exception $e) {
                return [
                    'message' => $e->getMessage(),
                ];
            }
        }

        if ($existUser->user_id !== $userId) {
            $existUser->user_id = $userId;
            try {
                $existUser->save();
            } catch (Exception $e) {
                return [
                    'message' => $e->getMessage(),
                ];
            }
        }

        return $existUser;
    }
}
