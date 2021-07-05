<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Services\FriendService;
use Tests\TestCase;

class FriendServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestUsers();
        $this->createTestFriends($this->user->id);
        $this->friendService = app(FriendService::class);
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testSearchFriends function
     * 友達検索して一覧取得のテスト
     * @return void
     */
    public function testSearchFriends()
    {
        // 検索ワード：なし
        $friendName = '';
        $friends = $this->friendService->searchFriends($friendName);

        $result = false;
        foreach ($friends as $friend) {
            if ($friend->user->name === 'テストユーザー1') {
                $result = true;
                break;
            }
        }
        $this->assertTrue($result);

        // 検索ワード：テスト
        $friendName = 'テスト';
        $friends = $this->friendService->searchFriends($friendName);
        $friendName = $friends->first()->user->name; 

        $result = false;
        foreach ($friends as $friend) {
            if ($friend->user->name === 'テストユーザー1') {
                $result = true;
                break;
            }
        }
        $this->assertTrue($result);
    }

    /**
     * testExistsFriend function
     * 友達登録されているか確認のテスト
     * @return void
     */
    public function testExistsFriend()
    {
        $friends = $this->getTestFriends($this->user->id);
        $friendUserId = $friends->first()->friend_id;
        $result = $this->friendService->existsFriend($friendUserId);
        $this->assertTrue($result);

        $friendUserId = 100000;
        $result = $this->friendService->existsFriend($friendUserId);
        $this->assertFalse($result);
    }

    /**
     * testAddFriend function
     * 友達追加のテスト
     * @return void
     */
    public function testAddFriend()
    {
        $friendUserId = 1000;
        $result = $this->friendService->addFriend($friendUserId);
        $this->assertTrue($result);
    }
}
