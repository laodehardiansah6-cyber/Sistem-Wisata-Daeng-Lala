<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle() 
    { 
        // Force Guzzle client untuk mengabaikan SSL
        $client = new Client(['verify' => false]);
        return Socialite::driver('google')->setHttpClient($client)->stateless()->redirect(); 
    }

    public function handleGoogleCallback()
    {
        try {
            // Force Guzzle client untuk mengabaikan SSL juga di callback
            $client = new Client(['verify' => false]);
            $googleUser = Socialite::driver('google')->setHttpClient($client)->stateless()->user();
            
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                $user->update(['google_id' => $googleUser->id]);
                Auth::login($user);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make('password123'),
                    'role' => 'user',
                    'email_verified_at' => now(),
                ]);
                Auth::login($newUser);
            }
            return redirect('/dashboard');
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Gagal login: ' . $e->getMessage());
        }
    }
}