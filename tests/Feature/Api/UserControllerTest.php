<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
    }
    
    /**
     * testSearchUsers function
     * ユーザー検索APIのテスト
     * @return void
     */
    public function testSearchUsers(): void
    {
        $response = $this->json('GET', route('search.users'));
        $response->assertStatus(200);
    }

    /**
     * testFindUser function
     * ユーザー情報取得APIのテスト
     * @return void
     */
    public function testFindUser(): void
    {
        $response = $this->json('GET', route('find.user'));
        $response->assertStatus(200);
    }

        /**
     * testUpdateProfile function
     * プロフィール更新APIのテスト
     * @return void
     */
    public function testUpdateProfile(): void
    {

        $response = $this->json('POST', route('update.profile'),
            [
                'name' => 'テスト',
                'email' => 'test@test.com',
            ]
        );
        $response->assertStatus(200);
    }
}
