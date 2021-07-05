<?php

namespace Tests\TestData;

use App\Models\GiftCategory;

trait GiftCategoryTestData
{
    /**
     * createTestGiftCategorys function
     * テスト用の景品カテゴリデータを作成
     * @return void
     */
    public function createTestGiftCategorys()
    {
        $data = [
            [
                'name' => 'Baby',
                'path' => 'baby',
                'title1' => 'Gifts for Baby',
                'title2' => '赤ちゃん',
                'icon' => 'fas fa-baby',
                'image' => '',
            ],
            [
                'name' => 'Kids',
                'path' => 'kids',
                'title1' => 'Gifts for Kids',
                'title2' => 'お子様',
                'icon' => 'fas fa-child',
                'image' => '',
            ],
            [
                'name' => 'Sweets',
                'path' => 'sweets',
                'title1' => 'Sweets Gifts',
                'title2' => 'お菓子',
                'icon' => 'fas fa-cookie',
                'image' => '',
            ],
        ];

        foreach ($data as $category) {
            GiftCategory::create($category);
        }

    }

}