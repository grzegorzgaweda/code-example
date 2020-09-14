<?php


namespace App\Services\LoginProviders\Google;



use App\Services\LoginProviders\LoginProvider;
use App\Services\LoginProviders\ProviderManager\ProviderManagerInterface;

class GoogleProvider implements LoginProvider
{
    private $manager;

    public function __construct(ProviderManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    function login()
    {
        return $this->manager
            ->setDriver('google')
            ->setOptions(['access_type' => 'offline'])
            ->redirect();
    }
}
