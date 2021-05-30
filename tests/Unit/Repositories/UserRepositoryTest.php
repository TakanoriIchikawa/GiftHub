<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function testSearchUsers(): void
    {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        // 検索ワード：なし
        $userName = '';
        $users = $this->userRepository->searchUsers($userName);
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
        $users = $this->userRepository->searchUsers($userName);
        $result = $users->where('name', '市川千耀')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', 'ジョナ3')->isNotEmpty();
        $this->assertTrue($result);
        $result = $users->where('name', '温泉饅頭')->isNotEmpty();
        $this->assertFalse($result);

        // 検索ワード：温泉
        $userName = '温泉';
        $users = $this->userRepository->searchUsers($userName);
        $result = $users->where('name', '市川千耀')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', 'ジョナ3')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', '温泉饅頭')->isNotEmpty();
        $this->assertTrue($result);
    }
}
