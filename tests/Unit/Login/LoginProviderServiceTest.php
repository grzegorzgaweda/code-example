<?php

namespace Tests\Unit;

use App\Services\LoginProviders\Google\GoogleCreator;
use App\Services\LoginProviders\Google\GoogleProvider;
use App\Services\LoginProviders\LoginProviderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginProviderServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var LoginProviderService
     */
    private $loginServiceProvider;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loginServiceProvider = app(LoginProviderService::class);
    }

    /** @test */
    public function login_by_google()
    {
        $providers = [
            'google' => GoogleProvider::class,
        ];
        foreach ($providers as $providerName => $provider) {
            $creator = $this->loginServiceProvider->loginBy($providerName);
            $this->assertEquals($provider, get_class($creator));
        }
    }

    /** @test */
    public function get_creator_for_provider_name()
    {
        $this->assertEquals(
            GoogleProvider::class,
            get_class($this->loginServiceProvider->getLoginProviderFor(new GoogleCreator))
        );
    }

    /** @test */
    public function throw_exception_for_non_existing_provider()
    {
        $this->expectException(\Exception::class);
        $this->loginServiceProvider->loginBy('not-existing-provider');
    }
}
