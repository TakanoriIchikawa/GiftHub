<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\GiftCategoryService;
use App\Models\GiftCategory;
use Tests\TestCase;

class GiftCategoryServiceTest extends TestCase
{
    use RefreshDatabase;

        public function setup(): void
    {
        parent::setUp();
        $this->seed('GiftCategoriesTableSeeder');
        $this->giftCategoryService = app(GiftCategoryService::class);
    }

    /**
     * testGetGiftCategories function
     * 景品のカテゴリ一覧取得のテスト
     * @return void
     */
    public function testGetGiftCategories(): void
    {
        $giftCategories = $this->giftCategoryService->getGiftCategories();
        $result = $giftCategories->where('name', 'Baby')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftCategories->where('name', 'Kids')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftCategories->where('name', 'Sweets')->isNotEmpty();
        $this->assertTrue($result);
        $result = $giftCategories->where('name', 'NotName')->isEmpty();
        $this->assertTrue($result);
    }
}
