<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Friend\FriendRepositoryInterface;
use Tests\TestCase;

class FriendRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestUsers();
        $this->createTestFriends($this->user->id);
        $this->createTestChatMessages($this->user->id);
        $this->friendRepository = app(FriendRepositoryInterface::class);
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
        $friends = $this->friendRepository->searchFriends($friendName);

        $result = $friends->count();
        $this->assertEquals(10, $result);

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
        $friends = $this->friendRepository->searchFriends($friendName);
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
        $userId = $this->user->id;

        $friends = $this->getTestFriends($userId);
        $friendUserId = $friends->first()->friend_id;
        $result = $this->friendRepository->existsFriend($userId, $friendUserId);
        $this->assertTrue($result);

        $friendUserId = 100000;
        $result = $this->friendRepository->existsFriend($userId, $friendUserId);
        $this->assertFalse($result);
    }

    /**
     * testAddFriend function
     * 保存処理のテスト
     * @return void
     */
    public function testAddFriend()
    {
        $userId = $this->user->id;
        $friendUserId = 1000;
        $params = [
            'user_id' => $userId,
            'friend_id' => $friendUserId,
        ];
        $result = $this->friendRepository->create($params);
        $this->assertEquals($result->user_id, $userId);
        $this->assertEquals($result->friend_id, $friendUserId);
    }

    /**
     * testGetFriendsWithLatestChatMessage function
     * 友達と最新のチャットメッセージを取得のテスト
     * @return void
     */
    public function testGetFriendsWithLatestChatMessage()
    {
        $friendsWithLatestChatMessage = $this->friendRepository->getFriendsWithLatestChatMessage();
        foreach ($friendsWithLatestChatMessage as $friend) {
            $latestSendChatMessage = $friend->latestSendChatMessage['message'];
            $latestReceiveChatMessage = $friend->latestReceiveChatMessage['message'];
            $this->assertEquals($latestSendChatMessage, 'テスト送信メッセージ');
            $this->assertEquals($latestReceiveChatMessage, 'テスト受信メッセージ');
        }
    }
}
