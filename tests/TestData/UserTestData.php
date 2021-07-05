<?php

namespace Tests\TestData;

use App\Models\User;

trait UserTestData
{
    /**
     * createTestUser function
     * テスト用のユーザー作成
     * @return object
     */
    public function createTestUser(): object
    {
        return User::create([
            'name' => '市川千耀',
            'email' => 'chiaki0223@test.com',
            'password' => bcrypt('chiaki0223'),
            'image' => '',
            'birth_year' => 2020,
            'birth_month' => 2,
            'birth_day' => 23,
            'location' => '静岡県'
        ]);
    }

    /**
     * createTestUsers function
     * テスト用のユーザー作成(100件)
     * @return void
     */
    public function createTestUsers(): void
    {
        User::create([
            'name' => 'テストユーザー1',
            'email' => 'test111@test.com',
            'password' => bcrypt('test111'),
        ]);

        User::create([
            'name' => 'テストユーザー2',
            'email' => 'test222@test.com',
            'password' => bcrypt('test222'),
        ]);

        factory(User::class, 100)->create();
    }

    /**
     * firstTestUser function
     * テスト用のユーザーデータを1件取得
     * @param string $email
     * @return object
     */
    public function firstTestUser(string $email): object
    {
        return User::where('email', $email)->first();
    }
}