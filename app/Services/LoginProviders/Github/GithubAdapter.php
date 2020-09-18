<?php


namespace App\Services\LoginProviders\Github;

use App\Services\LoginProviders\ProviderAdapter;
use App\User;

class GithubAdapter extends ProviderAdapter
{
    /**
     * @param \Laravel\Socialite\Two\User $user
     * @return User
     */
    public function getUser(\Laravel\Socialite\Two\User $user): User
    {
        $name = !is_null($this->data->name)
            ? $this->data->name
            : $this->data->nickname;

        return new User([
            'email' => $this->data->email,
            'name' => $name
        ]);
    }
}
