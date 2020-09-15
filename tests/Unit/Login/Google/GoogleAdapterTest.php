<?php


namespace Tests\Unit\Login;

use App\Services\LoginProviders\Google\GoogleAdapter;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GoogleAdapterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_user_from_google_response()
    {
        $response = $this->responseExampleData();
        $adapter = new GoogleAdapter($response);

        $user = $adapter->getUser();
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('email@gmail.com', $user->email);
        $this->assertEquals('John Smith', $user->name);
    }

    public function responseExampleData()
    {
        return json_decode('{
            "token": "ya29.a0afH6SMD-Gx8nty9KrKDRqjqkJ52vc-SJCT5t_eYLAtIuPfncjFPBdO3CyboPO5To0wgVv_AkGgJ46p0YQVc8IPYpOUloVOUHq0I-95VuQLgMCjisSpHnKDT88JvJ_tcp4R9-b02ta7ff8GVqnmvU_pwG8-r1SuGjG6A",
            "refreshToken": null,
            "expiresIn": 3598,
            "id": "109097448483154329454123",
            "nickname": null,
            "name": "John Smith",
            "email": "email@gmail.com",
            "avatar": "https://lh1.googleusercontent.com/a-/NO91Oh14GAJitks4ktWzTuRXuOEAKnKFcBGcnfVY8Vy-4EI",
            "user": {
                "sub": "109097448489554329452123",
                 "name": "John Smith",
                 "given_name": "John",
                 "family_name": "Smith",
                 "picture": "https://lh1.googleusercontent.com/a-/NO91Oh14GAJitks4ktWzTuRXuOEAKnKFcBGcnfVY8Vy-4EI",
                 "email": "email@gmail.com",
                 "email_verified": true,
                 "locale": "en",
                 "id": "109099442483454399454123",
                 "verified_email": true,
                 "link": null
            },
            "avatar_original": "https://lh1.googleusercontent.com/a-/NO91Oh14GAJitks4ktWzTuRXuOEAKnKFcBGcnfVY8Vy-4EI"
        }');
    }
}
