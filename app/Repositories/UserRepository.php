<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * @var User
     */
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function findByEmail(string $email): User
    {
        return $this->model->where('email', $email)->firstOrFail();
    }
}
