<?php

namespace Tests\TestData;

use App\Models\GiftItem;
use App\Models\GiftCategory;

trait GiftItemTestData
{
    /**
     * createTestGiftItems function
     * テスト用の景品データを作成
     * @return void
     */
    public function createTestGiftItems()
    {
        $giftCategories = GiftCategory::get();
        foreach ($giftCategories as $key => $value) {
            for ($i=1; $i<=5; $i++) {
                $data = [
                    'gift_category_id' => $value->id,
                    'name' => $value->title2 .$i,
                    'point' => 500,
                    'image' => '',
                ];
                GiftItem::create($data);
            }
        }
    }

    /**
     * firstTestGiftItem function
     * テスト用の景品データを1件取得
     * @param string $itemName
     * @return object
     */
    public function firstTestGiftItem(string $itemName): object
    {
        return GiftItem::where('name', $itemName)->first();
    }
}