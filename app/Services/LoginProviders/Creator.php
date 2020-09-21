<?php

namespace App\Services\LoginProviders;

use App\Services\LoginProviders\ProviderManager\ProviderManagerInterface;
use Laravel\Socialite\Contracts\User;

abstract class Creator
{
    abstract public function getProviderName(): string;

    abstract public function createLoginProvider(ProviderManagerInterface $manager);
}
