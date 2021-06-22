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
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
        // 検索ワード：なし
        $userName = '';
        $users = $this->userRepository->searchUsers($userName);
        $result = $users->count();
        $this->assertLessThanOrEqual(100, $result);
        $result = $users->where('name', '市川千耀')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', 'ジョナサン')->isNotEmpty();
        $this->assertTrue($result);
        $result = $users->where('name', 'マイケル')->isNotEmpty();
        $this->assertTrue($result);
        
        // 検索ワード：ジョナ
        $userName = 'ジョナ';
        $users = $this->userRepository->searchUsers($userName);
        $result = $users->where('name', '市川千耀')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', 'ジョナサン')->isNotEmpty();
        $this->assertTrue($result);
        $result = $users->where('name', 'マイケル')->isNotEmpty();
        $this->assertFalse($result);

        // 検索ワード：マイケル
        $userName = 'マイケル';
        $users = $this->userRepository->searchUsers($userName);
        $result = $users->where('name', '市川千耀')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', 'ジョナサン')->isNotEmpty();
        $this->assertFalse($result);
        $result = $users->where('name', 'マイケル')->isNotEmpty();
        $this->assertTrue($result);
    }
}
