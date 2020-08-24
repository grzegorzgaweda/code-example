<?php

namespace App\Services\LoginProviders;

abstract class Creator
{
    abstract public function createLoginProvider();
}
