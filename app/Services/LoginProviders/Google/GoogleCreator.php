<?php


namespace App\Services\LoginProviders\Google;



use App\Services\LoginProviders\Creator;
use App\Services\LoginProviders\LoginProvider;

class GoogleCreator extends Creator
{
    public function createLoginProvider(): LoginProvider
    {
        return new GoogleProvider();
    }
}
