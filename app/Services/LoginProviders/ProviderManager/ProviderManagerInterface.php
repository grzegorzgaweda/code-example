<?php

namespace App\Services\LoginProviders\ProviderManager;

use App\Services\LoginProviders\LoginProvider;
use App\User;

interface ProviderManagerInterface
{
    public function setDriver(string $driver);
    public function setProvider(LoginProvider $provider);
    public function setOptions(array $options);
    public function redirect();
    public function getUser(): User;
}
