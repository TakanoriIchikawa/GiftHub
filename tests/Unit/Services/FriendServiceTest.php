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
        $this->seed('UsersTableSeeder');
        $this->user = $this->getTestUser('chiaki');
        $this->createTestFriends($this->user->id);
        $this->friendService = app(FriendService::class);
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
        $friends = $this->friendService->searchFriends($friendName);

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
        $friends = $this->friendService->searchFriends($friendName);
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
        $friends = $this->friendService->searchFriends($friendName);
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
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        $friendUserId = 1000;
        $result = $this->friendService->addFriend($friendUserId);
        $this->assertTrue($result);
    }
}
