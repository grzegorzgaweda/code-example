<?php


namespace App\Services\LoginProviders\Google;



use App\Services\LoginProviders\LoginProvider;
use Laravel\Socialite\Facades\Socialite;

class GoogleProvider implements LoginProvider
{

    function login()
    {
        return Socialite::driver('google')
            ->with(['access_type' => 'offline'])
            ->redirect();
    }
}
