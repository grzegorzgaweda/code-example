<?php


namespace App\Services\LoginProviders\Github;

use App\Services\LoginProviders\LoginProvider;
use App\Services\LoginProviders\ProviderManager\ProviderManagerInterface;

class GithubProvider implements LoginProvider
{
    private $manager;

    public function __construct(ProviderManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function login()
    {
        return $this->manager
            ->setDriver('github')
            ->setOptions(['user:email', 'user:name'])
            ->redirect();
    }
}
