<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ExchangePoint\ExchangePointRepositoryInterface;
use Tests\TestCase;

class ExchangePointRepositoryTest extends TestCase
{
    use RefreshDatabase;
    
    public function setup(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestGivePoints($this->user->id);
        $this->createTestExchangePoints($this->user->id);
        $this->exchangePointRepository = app(ExchangePointRepositoryInterface::class);
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetExchangeGiftItems function
     * ポイントと交換した景品一覧取得のテスト
     * @return void
     */
    public function testGetExchangeGiftItems(): void
    {
        $exchangeGiftItems = $this->exchangePointRepository->getExchangeGiftItems();
        $result = $exchangeGiftItems->where('gift_item_id', 1)->isNotEmpty();
        $this->assertTrue($result);

        $result = $exchangeGiftItems->where('gift_item_id', 2)->isNotEmpty();
        $this->assertTrue($result);
    }

    /**
     * testCreate function
     * 保存処理のテスト
     * @return void
     */
    public function testCreate(): void
    {
        $params = [
            'user_id' => $this->user->id,
            'gift_item_id' => 1,
            'exchange_point' => 2000,
        ];
        $result = $this->exchangePointRepository->create($params);
        $this->assertEquals($result->user_id, $this->user->id);
        $this->assertEquals($result->gift_item_id, 1);
        $this->assertEquals($result->exchange_point, 2000);
    }

}
