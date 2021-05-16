<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\PrizeCategoryService;
use App\Models\PrizeCategory;
use Tests\TestCase;

class PrizeCategoryServiceTest extends TestCase
{
    use RefreshDatabase;

        public function setup(): void
    {
        parent::setUp();
        $this->createTestPrizeCategories();
        $this->prizeCategoryService = app(PrizeCategoryService::class);
    }

    /**
     * createTestPrizeCategories function
     * テストデータの作成
     * @return void
     */
    protected function createTestPrizeCategories(): void
    {
        $data = [
            [
                'name' => 'Baby',
                'path' => 'baby',
                'title1' => 'Prizes for Baby',
                'title2' => '赤ちゃん',
                'icon' => 'fas fa-baby',
                'image_name' => 'baby.jpg',
            ],
            [
                'name' => 'Kids',
                'path' => 'kids',
                'title1' => 'Prizes for Kids',
                'title2' => 'お子様',
                'icon' => 'fas fa-child',
                'image_name' => 'kids.jpg',
            ],
            [
                'name' => 'Sweets',
                'path' => 'sweets',
                'title1' => 'Sweets Prizes',
                'title2' => 'お菓子',
                'icon' => 'fas fa-cookie',
                'image_name' => 'sweets.jpg',
            ],
        ];

        foreach ($data as $category) {
            PrizeCategory::create($category);
        }
    }

    /**
     * testGetPrizeCategories function
     * 景品のカテゴリ一覧取得のテスト
     * @return void
     */
    public function testGetPrizeCategories(): void
    {
        $prizeCategories = $this->prizeCategoryService->getPrizeCategories();
        $result = $prizeCategories[0]['name'] === 'Baby' ? true : false;
        $this->assertTrue($result);
        $result = $prizeCategories[1]['name'] === 'Kids' ? true : false;
        $this->assertTrue($result);
        $result = $prizeCategories[2]['name'] === 'Sweets' ? true : false;
        $this->assertTrue($result);
        $result = $prizeCategories[0]['name'] === 'NotName' ? true : false;
        $this->assertFalse($result);
    }
}
