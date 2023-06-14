<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            // dd($googleUser->attributes['avatar']);

            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'password' => 'password123',
                    'avatar' => $googleUser->attributes['avatar'],
                ]
            );

            Auth::login($user);
            return redirect('/dashboard');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
