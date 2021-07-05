<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ExchangePointControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestGivePoints($this->user->id);
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetExchangeablePoint function
     * 交換可能なポイント取得APIのテスト
     * @return void
     */
    public function testGetExchangeablePoint(): void
    {
        $response = $this->json('GET', route('get.exchangeable.point'));
        $response->assertStatus(200);
    }

    /**
     * testExchangePoint function
     * ポイントと景品を交換するAPIのテスト
     * @return void
     */
    public function testExchangePoint(): void
    {
        $params = [
            'gift_item_id' => 2,
            'exchange_point' => 500,
        ];
        $response = $this->json('POST', route('exchange.point'), ['params' => $params]);
        $response->assertStatus(200);
    }
}
