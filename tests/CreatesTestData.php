<?php

namespace Tests;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Friend;
use App\Models\ChatMessage;
use App\Models\GrantPoint;

trait CreatesTestData
{
    /**
     * createTestUser function
     * テスト用のユーザーデータを作成
     * @return object
     */
    public function createTestUser(): object
    {
        return User::create([
            'name' => '市川千耀',
            'email' => 'chiaki0223@icloud.com',
            'password' => bcrypt('chiaki0223'),
        ]);
    }

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
     * createTestChatMessages function
     * テスト用のチャットメッセージを作成
     * @param integer $userId
     * @return void
     */
    public function createTestChatMessages(int $userId): void
    {
        $friends = Friend::where('user_id', $userId)
                        ->orderBy('id')
                        ->get();

        foreach ($friends as $friend) {
            $data = [
                'send_user_id' => $userId,
                'receive_user_id' => $friend->friend_id,
                'message' => 'テスト送信メッセージ',
            ];
            ChatMessage::create($data);

            $data = [
                'send_user_id' => $friend->friend_id,
                'receive_user_id' => $userId,
                'message' => 'テスト受信メッセージ',
            ];
            ChatMessage::create($data);
        }
    }

    /**
     * createTestGrantPoints function
     * テスト用の付与ポイントデータを作成
     * @param integer $userId
     * @return void
     */
    public function createTestGrantPoints(int $userId): void
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $dt = new Carbon();
        $oneMonthLater = $dt->addMonth(1);
        $dt = new Carbon;
        $twoMonthLater = $dt->addMonth(2);

        $data = [
            [
                'user_id' => $userId,
                'grant_point' => 500,
                'available_point' => 500,
                'expiration_date' => $yesterday,
            ],
            [
                'user_id' => $userId,
                'grant_point' => 1000,
                'available_point' => 500,
                'expiration_date' => $today,
            ],
            [
                'user_id' => $userId,
                'grant_point' => 1000,
                'available_point' => 1000,
                'expiration_date' => $tomorrow,
            ],
            [
                'user_id' => $userId,
                'grant_point' => 500,
                'available_point' => 500,
                'expiration_date' => $oneMonthLater,
            ],
            [
                'user_id' => $userId,
                'grant_point' => 500,
                'available_point' => 500,
                'expiration_date' => $twoMonthLater,
            ],
        ];

        foreach ($data as $grantPoint) {
            GrantPoint::create($grantPoint);
        }
    }

}