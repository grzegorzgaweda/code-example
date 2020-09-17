<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidLoginProviderException;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Services\LoginProviders\LoginProviderService;
use App\User;
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
        try {
            $provider = $this->loginProviderService->loginBy($providerName);

            return $provider->login();
        } catch (\Exception $exception) {
            return redirect()->route('login')->withErrors(['error' => 'Invalid provider']);
        }
    }

    public function callback($providerName)
    {
        try {

            $user = $this->loginProviderService->getProviderManager()->setDriver($providerName)->getUser();
            $this->authService->loginUser($user);

        } catch (InvalidLoginProviderException $exception) {

            return redirect()->route('login-provider.login', ['provider' => $providerName]);

        } catch (\Exception | UserNotFoundException $exception) {

            $this->authService->registerUser($user);
            $this->authService->loginUser($user);

        }

        return redirect()->route('home');
    }
}
