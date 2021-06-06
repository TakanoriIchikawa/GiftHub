<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
    }

    /**
     * testLoginApi function
     * ログインAPIのテスト
     * @return void
     */
    public function testLoginApi(): void
    {
        $data = [
            'login_id' => 'chiaki',
            'password' => 'chiaki0223',
        ];
        $response = $this->json('POST', route('login'), $data);

        $response->assertStatus(200)
                ->assertJson(['name' => $this->user->name]);

        $this->assertAuthenticatedAs($this->user);
    }
}
