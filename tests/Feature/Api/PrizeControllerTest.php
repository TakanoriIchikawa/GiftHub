<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PrizeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->seed('PrizesTableSeeder');
    }

    /**
     * testGetPrizeCategories function
     * 景品一覧取得APIのテスト
     * @return void
     */
    public function testGetPrizeCategories():void
    {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        $response = $this->json('GET', route('get.prizes'));
        $response->assertStatus(200);
    }
}
