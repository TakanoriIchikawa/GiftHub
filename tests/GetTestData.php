<?php

namespace Tests;

use App\Models\User;
use App\Models\Friend;

trait GetTestData
{
    /**
     * getTestUser function
     * テストユーザーを取得
     * @param string $loginId
     * @return object
     */
    public function getTestUser(string $loginId): object
    {
        return User::where('login_id', $loginId)
                    ->first();
    }

    /**
     * getTestFriends function
     * テスト用友達データを取得
     * @param integer $userId
     * @return object
     */
    public function getTestFriends(int $userId): object
    {
        return Friend::where('user_id', $userId)
                      ->get();
    }
}