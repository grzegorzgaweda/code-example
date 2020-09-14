<?php


namespace App\Services\LoginProviders\Google;


use App\Services\LoginProviders\ProviderAdapter;
use App\User;

class GoogleAdapter extends ProviderAdapter
{
    /**
     * @return User
     */
    public function getUser(): User
    {
        return new User(['email' => $this->data->email, 'name' => $this->data->name ]);
    }
}
