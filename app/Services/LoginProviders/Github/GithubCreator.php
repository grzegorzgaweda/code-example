<?php


namespace App\Services\LoginProviders\Github;

use App\Services\LoginProviders\Creator;
use App\Services\LoginProviders\LoginProvider;
use App\Services\LoginProviders\ProviderAdapter;
use App\Services\LoginProviders\ProviderManager\ProviderManagerInterface;


class GithubCreator extends Creator
{
    private $providerName = 'github';

    public function createLoginProvider(ProviderManagerInterface $manager): LoginProvider
    {
        return new GithubProvider($manager);
    }

    public function getProviderName(): string
    {
        return $this->providerName;
    }
}
