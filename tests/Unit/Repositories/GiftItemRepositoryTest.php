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
        $this->seed('GiftItemsTableSeeder');
        $this->giftItemRepository = app(GiftItemRepositoryInterface::class);
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
        $result = $giftItems->where('name', 'お子様のおもちゃA')->isEmpty();
        $this->assertTrue($result);

        // 景品カテゴリID：2
        $giftItems = $this->giftItemRepository->getGiftItems(2);
        $result = $giftItems->where('name', 'お子様のおもちゃA')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'お子様のおもちゃB')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', '赤ちゃんのおもちゃA')->isEmpty();
        $this->asserttrue($result);
    }
}
