<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
Use Auth;
use App\Models\{User, Social, Role};

class AuthSocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        if ($socialUser) {
            $user = $this->findOrCreateUser($socialUser, $this->convertProviderTotinyInt($provider));

            if (isset($user['message'])) {
                return redirect()->route('home')->with([
                    config('common.flash_message') => $user['message'],
                    config('common.flash_level_key') => 'danger'
                ]);
            }

            Auth::login($user);

            return redirect()->route('home')->with([
                config('common.flash_message') => trans('auth.login_success_via', ['provider' => $provider]),
                config('common.flash_level_key') => 'success'
            ]);
        }
    }

    protected function findOrCreateUser($socialUser, $provider)
    {
        $existUser = User::where('email', $socialUser->email)->first();

        if (empty($existUser)) {
            $newUser = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'avatar_link' => $socialUser->avatar,
                'confirmed' => true
            ]);

            if ($newUser) {
                $newUser->attachRole(Role::where('name', 'user')->first());
                $createSocialUser =  Social::firstOrCreate([
                    'user_id' => $newUser->id,
                    'provider' => $provider,
                    'provider_user_id' => $socialUser->id
                ]);

                return $newUser;

            } else {
                return ['message' => 'Thất bại'];
            }
        } else {
            $createSocialUser =  Social::firstOrCreate([
                'user_id' => $existUser->id,
                'provider' => $provider,
                'provider_user_id' => $socialUser->id
            ]);

            if ($createSocialUser) {
                return $existUser;
            } else {
                return ['message' => 'Thất bại'];
            }
        }
    }

    protected function convertProviderTotinyInt($provider)
    {
        switch ($provider) {
            case 'facebook':
                return 1;
                break;
            case 'google':
                return 2;
                break;
        }
    }
}
