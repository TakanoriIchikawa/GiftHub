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
        $this->seed('UsersTableSeeder');
        $this->user = $this->getTestUser('chiaki');
        $this->createTestFriends($this->user->id);
        $this->friendRepository = app(FriendRepositoryInterface::class);
    }

    /**
     * testSearchFriends function
     * 友達検索して一覧取得のテスト
     * @return void
     */
    public function testSearchFriends()
    {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        // 検索ワード：なし
        $friendName = '';
        $friends = $this->friendRepository->searchFriends($friendName);

        $result = $friends->count();
        $this->assertEquals(10, $result);

        $result = false;
        foreach ($friends as $friend) {
            if ($friend->user->name === 'ジョナサン') {
                $result = true;
                break;
            }
        }
        $this->assertTrue($result);

        $result = false;
        foreach ($friends as $friend) {
            if ($friend->user->name === 'マイケル') {
                $result = true;
                break;
            }
        }
        $this->assertTrue($result);

        // 検索ワード：ジョナサン
        $friendName = 'ジョナサン';
        $friends = $this->friendRepository->searchFriends($friendName);
        $friendName = $friends->first()->user->name; 

        $result = false;
        if ($friendName === 'ジョナサン') {
            $result = true;
        }
        $this->assertTrue($result);

        $result = false;
        if ($friendName === 'マイケル') {
            $result = true;
        }
        $this->assertFalse($result);

        // 検索ワード：マイケル
        $friendName = 'マイケル';
        $friends = $this->friendRepository->searchFriends($friendName);
        $friendName = $friends->first()->user->name;

        $result = false;
        if ($friendName === 'ジョナサン') {
            $result = true;
        }
        $this->assertFalse($result);

        $result = false;
        if ($friendName === 'マイケル') {
            $result = true;
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
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
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
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
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
}
