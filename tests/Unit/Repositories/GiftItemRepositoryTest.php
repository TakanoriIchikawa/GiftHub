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
        $result = $giftItems->where('name', 'はらぺこあおむし1')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'はらぺこあおむし2')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftItems->where('name', 'テスト1')->isEmpty();
        $this->assertTrue($result);
    }
}
