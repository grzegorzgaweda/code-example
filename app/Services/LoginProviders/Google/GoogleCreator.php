<?php


namespace App\Services\LoginProviders\Google;

use App\Services\LoginProviders\Creator;
use App\Services\LoginProviders\LoginProvider;
use App\Services\LoginProviders\ProviderManager\ProviderManagerInterface;

class GoogleCreator extends Creator
{
    public function createLoginProvider(ProviderManagerInterface $manager): LoginProvider
    {
        return new GoogleProvider($manager);
    }
}
