<?php

namespace Tests\TestData;

use App\Models\GivePoint;

trait GivePointTestData
{
    /**
     * createTestGivePoints function
     * テスト用のポイント（贈った・貰った）を作成
     * @param integer $userId
     * @return void
     */
    public function createTestGivePoints(int $userId): void
    {
        $data = [
            [
                'give_point' => 2000,
                'give_user_id' => $userId,
                'receive_user_id' => 2,
                'signature' => true,
                'message' => 'ありがとう',
            ],
            [
                'give_point' => 1000,
                'give_user_id' => $userId,
                'receive_user_id' => 3,
                'signature' => true,
                'message' => 'ありがとう',
            ],
            [
                'give_point' => 2000,
                'give_user_id' => 2,
                'receive_user_id' => $userId,
                'signature' => true,
                'message' => 'ありがとう',
            ],
            [
                'give_point' => 2000,
                'give_user_id' => 3,
                'receive_user_id' => $userId,
                'signature' => true,
                'message' => 'ありがとう',
            ],
        ];

        foreach ($data as $givePoint) {
            GivePoint::create($givePoint);
        }
    }
}