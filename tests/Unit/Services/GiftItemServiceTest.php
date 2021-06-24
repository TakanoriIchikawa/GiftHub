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
        $giftItems = $this->giftItemService->getGiftItems(1);
        $result = $giftItems->where('name', 'はらぺこあおむし1')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'はらぺこあおむし2')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'テスト1')->isEmpty();
        $this->assertTrue($result);
    }
}
