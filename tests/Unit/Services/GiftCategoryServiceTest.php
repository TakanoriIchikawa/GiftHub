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
        $this->createTestGiftCategories();
        $this->giftCategoryService = app(GiftCategoryService::class);
    }

    /**
     * createTestGiftCategories function
     * テストデータの作成
     * @return void
     */
    protected function createTestGiftCategories(): void
    {
        $data = [
            [
                'name' => 'Baby',
                'path' => 'baby',
                'title1' => 'Gifts for Baby',
                'title2' => '赤ちゃん',
                'icon' => 'fas fa-baby',
                'image_name' => 'baby.jpg',
            ],
            [
                'name' => 'Kids',
                'path' => 'kids',
                'title1' => 'Gifts for Kids',
                'title2' => 'お子様',
                'icon' => 'fas fa-child',
                'image_name' => 'kids.jpg',
            ],
            [
                'name' => 'Sweets',
                'path' => 'sweets',
                'title1' => 'Sweets Gifts',
                'title2' => 'お菓子',
                'icon' => 'fas fa-cookie',
                'image_name' => 'sweets.jpg',
            ],
        ];

        foreach ($data as $category) {
            GiftCategory::create($category);
        }
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
        $result = $giftCategories->where('name', 'NotName')->isNotEmpty();
        $this->assertFalse($result);
    }
}
