<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Services\ExchangePointService;
use Tests\TestCase;

class ExchangePointServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestGivePoints($this->user->id);
        $this->exchangePointService = app(ExchangePointService::class);
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetExchangeablePoint function
     * 交換可能なポイント取得のテスト
     * @return void
     */
    public function testGetExchangeablePoint(): void
    {
        $result = $this->exchangePointService->getExchangeablePoint();
        $this->assertEquals($result, 4000);
    }

    /**
     * testExchangePoint function
     * ポイントと景品交換のテスト
     * @return void
     */
    public function testExchangePoint(): void
    {
        $params = [
            'gift_item_id' => 1,
            'exchange_point' => 2000,
        ];
        $result = $this->exchangePointService->exchangePoint($params);
        $this->assertTrue($result);
    }
}
