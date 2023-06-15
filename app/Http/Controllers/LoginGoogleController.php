<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
                ]
            );

            // Fetch the avatar from google and swtore it in storage
            $content = file_get_contents($googleUser->avatar);
            $filename = time().'.png';
            Storage::disk('public')->put('avatars/' . $filename, $content);

            // Update the user with the new avatar
            $user->update([
                'avatar' => 'storage/avatars/' . $filename,
            ]);


            Auth::login($user);
            return redirect('/dashboard');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
