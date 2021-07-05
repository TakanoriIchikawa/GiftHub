<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GiftCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->createTestUser();
        $this->createTestGiftCategorys();
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetGiftCategories function
     * 景品カテゴリ一覧取得APIのテスト
     * @return void
     */
    public function testGetGiftCategories(): void
    {
        $response = $this->json('GET', route('get.gift.categories'));
        $response->assertStatus(200);
    }
}
