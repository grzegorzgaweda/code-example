<?php

namespace Tests\Unit\Repositories;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @var UserRepository
     */
    private $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = app(UserRepository::class);
    }

    /** @test */
    public function find_user_by_email()
    {
        $user = factory(User::class)->create();

        $found = $this->userRepository->findByEmail($user->email);
        $this->assertEquals($user->id, $found->id);
    }

    /** @test */
    public function throws_exception_for_non_existing_user()
    {
        $this->expectException(\Exception::class);
        $this->userRepository->findByEmail('non-existing@email.com');
    }
}
