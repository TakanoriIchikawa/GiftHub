<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PrizeCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->seed('PrizeCategoriesTableSeeder');
    }

    /**
     * testGetPrizes function
     * 景品カテゴリ一覧取得APIのテスト
     * @return void
     */
    public function testGetPrizes(): void
    {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        $response = $this->json('GET', route('get.prize.categories'));
        $response->assertStatus(200);
    }
}
