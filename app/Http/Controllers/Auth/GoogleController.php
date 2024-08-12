<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleRedirect()
    {
        $user_google = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'email' => $user_google->email
        ], [
            'email' => $user_google->email,
            'name' =>  $user_google->name,
            'password' => Hash::make(Str::random(24)),
            'role' => 'client'
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
