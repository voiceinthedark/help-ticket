<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;



class LoginGithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try{
            $githubUser = Socialite::driver('github')->user();


            $user = User::firstOrCreate([
                    'email' => $githubUser->email,
                ], [
                    'name' => $githubUser->name,
                    'password' => 'password123',
                ]);

            Auth::login($user);

            return redirect('/dashboard');
        } catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
