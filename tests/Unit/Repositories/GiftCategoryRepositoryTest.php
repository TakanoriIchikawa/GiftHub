<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\GiftCategory\GiftCategoryRepositoryInterface;
use Tests\TestCase;

class GiftCategoryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->createTestGiftCategorys();
        $this->giftCategoryRepository = app(GiftCategoryRepositoryInterface::class);
    }

    /**
     * testGetGiftCategories function
     * 景品のカテゴリ一覧取得のテスト
     * @return void
     */
    public function testGetGiftCategories(): void
    {
        $giftCategories = $this->giftCategoryRepository->getGiftCategories();
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
