<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetDashboardData function
     * ダッシュボードに表示するデータ取得APIのテスト
     * @return void
     */
    public function testGetDashboardData(): void
    {
        $response = $this->json('GET', route('get.dashboard.data'));
        $response->assertStatus(200);
    }
}
