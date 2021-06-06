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
        $this->seed('GiftItemsTableSeeder');
        $this->giftItemService = app(GiftItemService::class);
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
        $result = $giftItems->where('name', 'お子様のおもちゃA')->isEmpty();
        $this->assertTrue($result);

        // 景品カテゴリID：2
        $giftCategoryId = 2;
        $giftItems = $this->giftItemService->getGiftItems($giftCategoryId);
        $result = $giftItems->where('name', 'お子様のおもちゃA')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'お子様のおもちゃB')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', '赤ちゃんのおもちゃA')->isEmpty();
        $this->assertTrue($result);
    }
}
