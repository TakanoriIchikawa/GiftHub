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
    }
    
    /**
     * testSearchUsers function
     * ユーザー検索APIのテスト
     * @return void
     */
    public function testSearchUsers(): void
    {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        $response = $this->json('GET', route('search.users'));
        $response->assertStatus(200);
    }
}
