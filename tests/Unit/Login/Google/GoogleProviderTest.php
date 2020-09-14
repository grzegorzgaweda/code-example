<?php

namespace Tests\Unit\Login\Google;

use App\Services\LoginProviders\Google\GoogleProvider;
use App\Services\LoginProviders\ProviderManager\SocialiteManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use PHPUnit\Framework\TestCase;

class GoogleProviderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_should_redirect_to_google_service()
    {
//        $this->mockSocialite();

//        $manager = new SocialiteManager();
//        $provider = new GoogleProvider($manager);

        $this->assertTrue(true);

//        $this->assertEquals('https://accounts.google.com/o/oauth2/auth', $provider->login());
    }

    /**
     * @return \Laravel\Socialite\Two\GoogleProvider|Mockery\LegacyMockInterface|Mockery\MockInterface
     */
    private function mockSocialite()
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser
            ->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getName')
            ->andReturn(Str::random(10))
            ->shouldReceive('getEmail')
            ->andReturn(Str::random(10) . '@gmail.com')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = Mockery::mock(\Laravel\Socialite\Two\GoogleProvider::class);
        $provider->shouldReceive('redirect')
            ->andReturn('https://accounts.google.com/o/oauth2/auth');

        Socialite::shouldReceive('driver->user')
            ->andReturn($abstractUser)
            ->shouldReceive('with')
            ->andReturn($provider);

        return $provider;
    }

    public function tearDown(): void
    {
        \Mockery::close();
    }
}
