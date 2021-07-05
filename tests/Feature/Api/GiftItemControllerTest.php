<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GiftItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->createTestUser();
        $this->createTestUsers();
        $this->createTestGiftCategorys();
        $this->createTestGiftItems();
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetGiftItems function
     * 景品一覧取得APIのテスト
     * @return void
     */
    public function testGetGiftItems(): void
    {
        $response = $this->json('GET', route('get.gift.items'));
        $response->assertStatus(200);
    }
}
