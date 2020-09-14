<?php

namespace App\Services\LoginProviders;

use App\Services\LoginProviders\ProviderManager\ProviderManagerInterface;

abstract class Creator
{
    abstract public function createLoginProvider(ProviderManagerInterface $manager);
}
