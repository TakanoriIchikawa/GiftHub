<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Prize\PrizeRepositoryInterface;
use App\Models\Prize;
use Tests\TestCase;

class PrizeRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->createTestPrizes();
        $this->prizeRepository = app(PrizeRepositoryInterface::class);
    }

    /**
     * createTestPrizes function
     * テストデータの作成
     * @return void
     */
    protected function createTestPrizes(): void
    {
        $data = [
            [
                'prize_category_id' => 1,
                'name' => '赤ちゃんのおもちゃA',
                'points' => 1500,
            ],
            [
                'prize_category_id' => 1,
                'name' => '赤ちゃんのおもちゃB',
                'points' => 1000,
            ],
            [
                'prize_category_id' => 2,
                'name' => 'お子様のおもちゃA',
                'points' => 3000,
            ],
            [
                'prize_category_id' => 2,
                'name' => 'お子様のおもちゃB',
                'points' => 2000,
            ],
        ];

        foreach ($data as $category) {
            Prize::create($category);
        }
    }

    /**
     * testGetPrizes function
     * 景品の一覧取得のテスト
     * @return void
     */
    public function testGetPrizes(): void
    {
        // 景品カテゴリID：1
        $prizes = $this->prizeRepository->getPrizes(1);
        $result = $prizes->where('name', '赤ちゃんのおもちゃA')->isNotEmpty();
        $this->assertTrue($result);
        $result = $prizes->where('name', '赤ちゃんのおもちゃB')->isNotEmpty();
        $this->assertTrue($result);
        $result = $prizes->where('name', 'お子様のおもちゃA')->isNotEmpty();
        $this->assertFalse($result);

        // 景品カテゴリID：2
        $prizes = $this->prizeRepository->getPrizes(2);
        $result = $prizes->where('name', 'お子様のおもちゃA')->isNotEmpty();
        $this->assertTrue($result);
        $result = $prizes->where('name', 'お子様のおもちゃB')->isNotEmpty();
        $this->assertTrue($result);
        $result = $prizes->where('name', '赤ちゃんのおもちゃA')->isNotEmpty();
        $this->assertFalse($result);
    }
}
