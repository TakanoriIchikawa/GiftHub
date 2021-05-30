<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\GiftItem\GiftItemRepositoryInterface;
use App\Models\GiftItem;
use Tests\TestCase;

class GiftItemRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->createTestGiftItems();
        $this->giftItemRepository = app(GiftItemRepositoryInterface::class);
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
        $giftItems = $this->giftItemRepository->getGiftItems(1);
        $result = $giftItems->where('name', '赤ちゃんのおもちゃA')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', '赤ちゃんのおもちゃB')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'お子様のおもちゃA')->isNotEmpty();
        $this->assertFalse($result);

        // 景品カテゴリID：2
        $giftItems = $this->giftItemRepository->getGiftItems(2);
        $result = $giftItems->where('name', 'お子様のおもちゃA')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'お子様のおもちゃB')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', '赤ちゃんのおもちゃA')->isNotEmpty();
        $this->assertFalse($result);
    }
}
