<?php

namespace App\Services\LoginProviders\ProviderManager;

use App\User;

interface ProviderManagerInterface
{
    public function setDriver(string $driver);
    public function setOptions(array $options);
    public function redirect();
    public function getUser(): User;
}
