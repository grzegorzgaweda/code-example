<?php


namespace App\Services\LoginProviders;

use App\User;

abstract class ProviderAdapter
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    abstract public function getUser(): User;
}
