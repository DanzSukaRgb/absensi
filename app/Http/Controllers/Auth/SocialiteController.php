<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();
        $registeredUser = User::where('google_id', $socialUser->id)->first();

        if (!$registeredUser) {

            $user = User::updateOrCreate([
                'google_id' => $socialUser->id,
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('123'),
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        }

        Auth::login($registeredUser);

        return redirect('/dashboard');
    }
}