<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Services\GrantPointService;
use Carbon\Carbon;
use Tests\TestCase;

class GrantPointServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestGrantPoints($this->user->id);
        $this->grantPointService = app(GrantPointService::class);
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetAvailablePoint function
     * 利用可能なポイントを取得、合計値を算出のテスト
     * @return void
     */
    public function testGetAvailablePoint(): void
    {
        $result = $this->grantPointService->getAvailablePoint();
        $this->assertSame($result, 2500);
    }

    /**
     * testChargeGrantPoint function
     * ポイントチャージのテスト
     * @return void
     */
    public function testChargeGrantPoint()
    {
        $params = [
            'grant_point' => 1000,
        ];
        $result = $this->grantPointService->chargeGrantPoint($params);
        $this->assertEquals($result->user_id, $this->user->id);
        $this->assertEquals($result->grant_point, 1000);
        $this->assertEquals($result->available_point, 1000);

        $date = new Carbon;
        $expirationDate = $date->addMonth(2)->format('Y-m-d');
        $this->assertEquals($result->expiration_date, $expirationDate);
    }
}
