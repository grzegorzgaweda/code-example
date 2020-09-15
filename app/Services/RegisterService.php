<?php


namespace App\Services;

use App\Repositories\UserRepository;
use App\User;

class RegisterService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(User $user)
    {
        try {
            $this->userRepository->findByEmail($user->email);
        } catch (\Exception $exception) {
            $user->save();
        }

        return $user;
    }
}
