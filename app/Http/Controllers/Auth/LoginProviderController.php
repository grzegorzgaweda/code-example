<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Services\LoginProviders\LoginProviderService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginProviderController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var LoginProviderService
     */
    private $loginProviderService;
    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(LoginProviderService $loginProviderService, AuthService $authService)
    {
        $this->loginProviderService = $loginProviderService;
        $this->authService = $authService;
    }

    /**
     * @param string $providerName
     * @return mixed
     * @throws \Exception
     */
    public function loginByProvider(string $providerName)
    {
        $provider = $this->loginProviderService->loginBy($providerName);

        return $provider->login();
    }

    public function callback($providerName)
    {
        try {
            $user = $this->loginProviderService->getProviderManager()->setDriver($providerName)->getUser();
        } catch (\Exception $exception) {
            return redirect()->route('login-provider.login', ['provider' => $providerName]);
        }

        try {
            $this->authService->loginUser($user);
            $this->authService->registerUser($user);
        } catch (UserNotFoundException $exception) {
            $this->authService->loginUser($user);
        }

        return redirect()->route('home');
    }
}
