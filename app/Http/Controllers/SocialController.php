<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    //facebook
    public function redirectFB()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFB()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect('/dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($createUser);
                return redirect('/dashboard');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    // vkontakte
    public function redirectVK()
    {
        //
    }

    public function callbackVK()
    {
        //
    }

    // github
    public function redirectGH()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callbackGH()
    {
//        $user = Socialite::driver('github')->user();
//        dd($user);
    }
}
