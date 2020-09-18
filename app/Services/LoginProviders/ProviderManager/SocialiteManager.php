<?php


namespace App\Services\LoginProviders\ProviderManager;

use App\Services\LoginProviders\LoginProvider;
use App\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;

class SocialiteManager implements ProviderManagerInterface
{
    private $driver;

    private $options;
    /**
     * @var LoginProvider
     */
    private $provider;

    public function setDriver(string $driver)
    {
        $this->driver = $driver;

        return $this;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function redirect()
    {
        return Socialite::driver($this->driver)
            ->with($this->options)
            ->redirect();
    }

    public function getUser(): User
    {
        $socialiteUser = Socialite::driver($this->driver)->user();

        return $this->transformToUser($socialiteUser);
    }

    private function transformToUser(SocialiteUser $socialiteUser)
    {
        $name = !is_null($socialiteUser->name)
            ? $socialiteUser->name
            : $socialiteUser->email;

        return new User([
            'email' => $socialiteUser->email,
            'name' => $name,
            'password' => bcrypt(Str::random(16))
        ]);
    }

    public function setProvider(LoginProvider $provider)
    {
        $this->provider = $provider;

        return $this;
    }
}
