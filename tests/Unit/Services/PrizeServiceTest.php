<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\PrizeService;
use App\Models\Prize;
use Tests\TestCase;

class PrizeServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->createTestPrizes();
        $this->prizeService = app(PrizeService::class);
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
        $prizes = $this->prizeService->getPrizes(1);
        $result = $prizes[0]['name'] === '赤ちゃんのおもちゃA' ? true : false;
        $this->assertTrue($result);
        $result = $prizes[1]['name'] === '赤ちゃんのおもちゃB' ? true : false;
        $this->assertTrue($result);
        $result = $prizes[0]['name'] === 'お子様のおもちゃA' ? true : false;
        $this->assertFalse($result);

        // 景品カテゴリID：2
        $prizes = $this->prizeService->getPrizes(2);
        $result = $prizes[0]['name'] === 'お子様のおもちゃA' ? true : false;
        $this->assertTrue($result);
        $result = $prizes[1]['name'] === 'お子様のおもちゃB' ? true : false;
        $this->assertTrue($result);
        $result = $prizes[0]['name'] === '赤ちゃんのおもちゃA' ? true : false;
        $this->assertFalse($result);
    }
}
