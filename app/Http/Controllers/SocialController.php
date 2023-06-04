<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class SocialController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        $provider_id = $user->getId();
        $email = $user->getEmail();
        
        $data = User::where('provider_id',$provider_id)->where('email',$email)->first();
        
        if($data)
            {
            auth()->login($data);
            }
         else
             {
               User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'provider_id' => $user->getId(),
                    'provider_name' => 'google'
                ]);
             }
             return redirect('/');
// $user->token;
    }
}
