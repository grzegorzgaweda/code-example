<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\LoginProviders\GoogleCreator;
use App\Services\LoginProviders\LoginService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginProviderController extends Controller
{
    /**
     * @var LoginService
     */
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * @param $providerName
     * @return mixed
     * @throws \Exception
     */
    public function login($providerName)
    {
        $provider = $this->loginService->loginBy($providerName);

        return $provider->login();
    }

    public function callback($providerName)
    {
        $user = Socialite::driver($providerName)->user();

        dd($user);
    }

}
