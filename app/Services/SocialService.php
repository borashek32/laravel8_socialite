<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialService
{
    public function saveSocialData($user)
    {
        $user = Socialite::driver('vkontakte')->user();

        $email     = $user->getEmail();
        $name      = $user->getName();
        $avatar    = $user->getAvatar();
        $password  =  Hash::make('11111111');

        $user = User::firstOrCreate(
            [
                'email'  =>  $email
            ],
            [
            'email'    => $email,
            'password' => $password,
            'name'     => $name,
            'avatar'   => $avatar
        ]);

        if ($user) {

            return $user->fill([
                'name'   => $user->name,
                'avatar' => $user->avatar
            ]);
        }

        return User::create($user);
    }
}
