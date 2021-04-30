<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LogoutApiTest extends TestCase
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
     * @return object
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
     * testLogoutApi function
     * ログアウトAPIのテスト
     * @return void
     */
    public function testLogoutApi(): void
    {
        $response = $this->actingAs($this->user)->json('POST', route('logout'));

        $response->assertStatus(200);
        $this->assertGuest();
    }
}
