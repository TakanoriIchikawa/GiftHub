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
        $this->createTestUser();
        $this->createTestUsers();
        $this->userService = app(UserService::class);
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testSearchUsers function
     * ユーザー検索して一覧取得のテスト
     * @return void
     */
    public function testSearchUsers(): void
    {
        // 検索ワード：なし
        $userName = '';
        $users = $this->userService->searchUsers($userName);
        $result = $users->count();
        $this->assertLessThanOrEqual(100, $result);
        $result = $users->where('name', '市川千耀')->isEmpty();
        $this->assertTrue($result);
        $result = $users->where('name', 'テストユーザー1')->isNotEmpty();
        $this->assertTrue($result);
        $result = $users->where('name', 'テストユーザー2')->isNotEmpty();
        $this->assertTrue($result);

        // 検索ワード：テスト
        $userName = 'テスト';
        $users = $this->userService->searchUsers($userName);
        $result = $users->where('name', '市川千耀')->isEmpty();
        $this->assertTrue($result);
        $result = $users->where('name', 'テストユーザー1')->isNotEmpty();
        $this->assertTrue($result);
        $result = $users->where('name', 'テストユーザー2')->isNotEmpty();
        $this->assertTrue($result);
    }

    /**
     * testFindUser function
     * ユーザー情報を1件取得のテスト
     * @return void
     */
    public function testFindUser(): void
    {
        $result = $this->userService->findUser();
        $this->assertEquals($result->name, '市川千耀');
        $this->assertEquals($result->email, 'chiaki0223@test.com');
    }

    /**
     * testValidateParams function
     * 入力値検証のテスト
     * @return void
     */
    public function testValidateParams(): void
    {
        $params = [
            'name' => '',
            'email' => 'test@test.com',
        ];
        $result = $this->userService->validateParams($params);
        $this->assertFalse($result);

        $params = [
            'name' => 'test',
            'email' => '',
        ];
        $result = $this->userService->validateParams($params);
        $this->assertFalse($result);

        $params = [
            'name' => 'test',
            'email' => 'test@test.com',
        ];
        $result = $this->userService->validateParams($params);
        $this->assertTrue($result);
    }

    /**
     * testUpdateProfile function
     * プロフィール更新のテスト
     * @return void
     */
    public function testUpdateProfile(): void
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
        $result = $this->userService->updateProfile($params);
        $this->assertTrue($result);
    }
}
