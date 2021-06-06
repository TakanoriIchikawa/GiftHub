<?php

namespace Tests;

use Carbon\Carbon;
use App\Models\User;
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
            'login_id' => 'chiaki',
            'email' => 'chiaki0223@icloud.com',
            'password' => bcrypt('chiaki0223'),
        ]);
    }

    /**
     * createTestGrantPoints function
     * テスト用の付与ポイントデータを作成
     * @param integer $userId
     * @return void
     */
    public function createTestGrantPoints($userId): void
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