<?php


namespace App\Services\LoginProviders\ProviderManager;

use App\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;

class SocialiteManager implements ProviderManagerInterface
{
    private $driver;

    private $options;

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
        return new User([
            'email' => $socialiteUser->email,
            'name' => $socialiteUser->name,
            'password' => bcrypt(Str::random(16))
        ]);
    }
}
