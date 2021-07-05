<?php

namespace Tests\TestData;

use App\Models\Friend;
use App\Models\User;

trait FriendTestData
{
    /**
     * createTestFriends function
     * テスト用の友達データを作成
     * @param integer $userId
     * @return void
     */
    public function createTestFriends(int $userId): void
    {
        $users = User::where('id', '!=', $userId)
                        ->orderBy('id')
                        ->limit(10)
                        ->get();
                        
        foreach ($users as $user) {
            $data = [
                'user_id' => $userId,
                'friend_id' => $user->id,
            ];
            Friend::create($data);
        }
    }

    /**
     * getTestFriends function
     * テスト用友達データを取得
     * @param integer $userId
     * @return object
     */
    public function getTestFriends(int $userId): object
    {
        return Friend::where('user_id', $userId)->get();
    }

}