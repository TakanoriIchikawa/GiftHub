<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\GiftItemService;
use App\Models\GiftItem;
use Tests\TestCase;

class GiftItemServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->createTestGiftItems();
        $this->giftItemService = app(GiftItemService::class);
    }

    /**
     * createTestGiftItems function
     * テストデータの作成
     * @return void
     */
    protected function createTestGiftItems(): void
    {
        $data = [
            [
                'gift_category_id' => 1,
                'name' => '赤ちゃんのおもちゃA',
                'point' => 1500,
            ],
            [
                'gift_category_id' => 1,
                'name' => '赤ちゃんのおもちゃB',
                'point' => 1000,
            ],
            [
                'gift_category_id' => 2,
                'name' => 'お子様のおもちゃA',
                'point' => 3000,
            ],
            [
                'gift_category_id' => 2,
                'name' => 'お子様のおもちゃB',
                'point' => 2000,
            ],
        ];

        foreach ($data as $item) {
            GiftItem::create($item);
        }
    }

    /**
     * testGetGiftItems function
     * 景品の一覧取得のテスト
     * @return void
     */
    public function testGetGiftItems(): void
    {
        // 景品カテゴリID：1
        $giftCategoryId = 1;
        $giftItems = $this->giftItemService->getGiftItems($giftCategoryId);
        $result = $giftItems->where('name', '赤ちゃんのおもちゃA')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', '赤ちゃんのおもちゃB')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'お子様のおもちゃA')->isNotEmpty();
        $this->assertFalse($result);

        // 景品カテゴリID：2
        $giftCategoryId = 2;
        $giftItems = $this->giftItemService->getGiftItems($giftCategoryId);
        $result = $giftItems->where('name', 'お子様のおもちゃA')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'お子様のおもちゃB')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', '赤ちゃんのおもちゃA')->isNotEmpty();
        $this->assertFalse($result);
    }
}
