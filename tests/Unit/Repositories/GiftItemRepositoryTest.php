<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\GiftItem\GiftItemRepositoryInterface;
use Tests\TestCase;

class GiftItemRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->createTestGiftCategorys();
        $this->createTestGiftItems();
        $this->giftItemRepository = app(GiftItemRepositoryInterface::class);
    }

    /**
     * testGetGiftItems function
     * 景品の一覧取得のテスト
     * @return void
     */
    public function testGetGiftItems(): void
    {
        $giftItem = $this->firstTestGiftItem('赤ちゃん1');
        $giftItems = $this->giftItemRepository->getGiftItems($giftItem->gift_category_id);
        $result = $giftItems->where('name', '赤ちゃん1')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', '赤ちゃん2')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'お菓子1')->isEmpty();
        $this->assertTrue($result);
    }
}
