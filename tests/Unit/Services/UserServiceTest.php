<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->userService = app(UserService::class);
    }

    /**
     * testSearchUsers function
     * ユーザー検索して一覧取得のテスト
     * @return void
     */
    public function testSearchUsers(): void
    {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        // 検索ワード：なし
        $userName = '';
        $users = $this->userService->searchUsers($userName);
        $result = $users->count();
        $this->assertLessThanOrEqual(100, $result);
        $result = $users->where('name', '市川千耀')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', 'ジョナ3')->isNotEmpty();
        $this->assertTrue($result);
        $result = $users->where('name', '温泉饅頭')->isNotEmpty();
        $this->assertTrue($result);
        
        // 検索ワード：ジョナ
        $userName = 'ジョナ';
        $users = $this->userService->searchUsers($userName);
        $result = $users->where('name', '市川千耀')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', 'ジョナ3')->isNotEmpty();
        $this->assertTrue($result);
        $result = $users->where('name', '温泉饅頭')->isNotEmpty();
        $this->assertFalse($result);

        // 検索ワード：温泉
        $userName = '温泉';
        $users = $this->userService->searchUsers($userName);
        $result = $users->where('name', '市川千耀')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', 'ジョナ3')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', '温泉饅頭')->isNotEmpty();
        $this->assertTrue($result);
    }
}
