<?php

namespace Tests\TestData;

use App\Models\ExchangePoint;

trait ExchangePointTestData
{
    /**
     * createTestExchangePoints function
     * テスト用のポイントと景品交換データ作成
     * @param integer $userId
     * @return void
     */
    public function createTestExchangePoints(int $userId): void
    {
        $data = [
            [
                'user_id' => $userId,
                'gift_item_id' => 1,
                'exchange_point' => 500,    
            ],
            [
                'user_id' => $userId,
                'gift_item_id' => 2,
                'exchange_point' => 500,    
            ],
        ];

        foreach ($data as $exchangePoint) {
            ExchangePoint::create($exchangePoint);
        }
    }
}