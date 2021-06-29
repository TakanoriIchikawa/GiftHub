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
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
    }

    /**
     * testSearchUsers function
     * ユーザー検索のテスト
     * @return void
     */
    public function testSearchUsers(): void
    {
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

    /**
     * testFindUser function
     * ユーザー情報を1件取得のテスト
     * @return void
     */
    public function testFindUser(): void
    {
        $result = $this->userRepository->findUser(Auth::id());
        $this->assertEquals($result->name, '市川千耀');
        $this->assertEquals($result->email, 'chiaki0223@icloud.com');
    }

    /**
     * testUpdate function
     * 更新処理のテスト
     * @return void
     */
    public function testUpdate(): void
    {
        $params = [
            'name' => 'test',
            'email' => 'test@test.com',
            'birth_year' => 2020,
            'birth_month' => 2,
            'birth_day' => 23,
            'location' => '北海道',
            'image' => '1.jpg',
        ];

        $user = $this->userRepository->findUser(Auth::id());
        $user->fill($params);

        $result = $this->userRepository->update($user);
        $this->assertTrue($result);
    }
}
