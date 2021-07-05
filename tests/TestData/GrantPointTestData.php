<?php

namespace Tests\TestData;

use Carbon\Carbon;
use App\Models\GrantPoint;

trait GrantPointTestData
{
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