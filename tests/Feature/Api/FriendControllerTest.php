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
        $this->seed('UsersTableSeeder');
        $this->seed('FriendsTableSeeder');
    }

    /**
     * testSearchFriends function
     * 友達検索APIのテスト
     * @return void
     */
    public function testSearchFriends()
    {
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
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
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
        $params = [
            'friend_user_id' => 2,
        ];
        $response = $this->json('POST', route('add.friend'), ['params' => $params]);
        $response->assertStatus(200);
    }
}
