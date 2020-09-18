<?php


namespace App\Services\LoginProviders;

use App\User;

abstract class ProviderAdapter
{
    abstract public function getUser(\Laravel\Socialite\Two\User $user): User;
}
