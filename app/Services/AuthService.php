<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RegisterService
     */
    private $registerService;

    public function __construct(UserRepository $userRepository, RegisterService $registerService)
    {
        $this->userRepository = $userRepository;
        $this->registerService = $registerService;
    }


    /**
     * @param User $user
     */
    public function loginUser(User $user)
    {
        $user = $this->userRepository->findByEmail($user->email);
        Auth::guard()->login($user);
    }

    public function registerUser(User $user)
    {
        return $this->registerService->register($user);
    }
}
