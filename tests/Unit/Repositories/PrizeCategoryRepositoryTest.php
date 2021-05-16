<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\PrizeCategory\PrizeCategoryRepositoryInterface;
use App\Models\PrizeCategory;
use Tests\TestCase;

class PrizeCategoryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->createTestPrizeCategories();
        $this->prizeCategoryRepository = app(PrizeCategoryRepositoryInterface::class);
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
        $prizeCategories = $this->prizeCategoryRepository->getPrizeCategories();
        $result = $prizeCategories->where('name', 'Baby')->isNotEmpty();
        $this->assertTrue($result);
        $result = $prizeCategories->where('name', 'Kids')->isNotEmpty();
        $this->assertTrue($result);
        $result = $prizeCategories->where('name', 'Sweets')->isNotEmpty();
        $this->assertTrue($result);
        $result = $prizeCategories->where('name', 'NotName')->isNotEmpty();
        $this->assertFalse($result);
    }
}
