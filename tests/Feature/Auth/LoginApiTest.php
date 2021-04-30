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
     * createTestUser function
     * テスト用ユーザーの作成
     * @return oblect
     */
    protected function createTestUser(): object
    {
        return User::create([
            'name' => '市川千耀',
            'login_id' => 'chiaki',
            'email' => 'chiaki0223@icloud.com',
            'password' => bcrypt('chiaki0223'),
        ]);
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
