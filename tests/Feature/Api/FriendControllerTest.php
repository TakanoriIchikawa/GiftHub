<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class FriendControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->createTestUser();
        $this->createTestUsers();
        $this->seed('FriendsTableSeeder');
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testSearchFriends function
     * 友達検索APIのテスト
     * @return void
     */
    public function testSearchFriends()
    {
        $response = $this->json('GET', route('search.friends'));
        $response->assertStatus(200);
    }

    /**
     * Undocumented function
     * 友達追加APIのテスト
     * @return void
     */
    public function testAddFriend()
    {
        $params = [
            'friend_user_id' => 2,
        ];
        $response = $this->json('POST', route('add.friend'), ['params' => $params]);
        $response->assertStatus(200);
    }
}
