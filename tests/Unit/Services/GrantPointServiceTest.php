<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Services\GrantPointService;
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
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
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
}
