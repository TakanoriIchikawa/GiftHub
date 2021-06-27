<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Services\DashboardService;
use Tests\TestCase;

class DashboardServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->dashboardService = app(DashboardService::class);
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetDashboardPoints function
     * 各ポイントの一覧取得のテスト
     * @return void
     */
    public function testGetDashboardPoints(): void
    {
        $points = $this->dashboardService->getDashboardPoints();
        foreach ($points as $point) {
            $this->assertLessThanOrEqual($point, 0);
        }
    }

    /**
     * Undocumented function
     * 直近の各やりとり取得のテスト
     * @return void
     */
    public function testGetDashboardList(): void
    {
        $list = $this->dashboardService->getDashboardList();

        $result = false;
        if (isset($list['give_point_friends'])) {
            $result = true;
        }
        $this->assertTrue($result);

        $result = false;
        if (isset($list['receive_point_friends'])) {
            $result = true;
        }
        $this->assertTrue($result);

        $result = false;
        if (isset($list['exchange_gift_items'])) {
            $result = true;
        }
        $this->assertTrue($result);
    }
}
