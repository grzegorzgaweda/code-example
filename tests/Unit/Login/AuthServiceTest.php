<?php

namespace Tests\Unit\Login;

use App\Services\AuthService;
use App\User;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    private $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = app(AuthService::class);
    }

    /** @test */
    public function user_is_logged_in()
    {
        $user = factory(User::class)->create();

        $this->authService->loginUser($user);
        $this->assertAuthenticated();
    }

    /** @test */
    public function user_is_registered()
    {
        /** @var User $user */
        $user = factory(User::class)->make();
        $this->assertDatabaseMissing('users', $user->only(['name', 'email']));
        $this->authService->registerUser($user);
        $this->assertDatabaseHas('users', $user->only(['name', 'email']));
    }
}
