<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Services\GivePointService;
use Tests\TestCase;

class GivePointServiceTest extends TestCase
{
    use RefreshDatabase;

    const TEST_PARAMS = [
        'receive_user_id' => 2,
        'give_point' => 200,
        'signature' => true,
        'message' => 'テストです。',
    ];

    public function setup(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestGrantPoints($this->user->id);
        $this->createTestGivePoints($this->user->id);
        $this->givePointService = app(GivePointService::class);
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGivePoint function
     * 有効ポイントを贈るポイント分減らし、ポイントを贈る処理のテスト
     * @return void
     */
    public function testGivePoint(): void
    {
        $testParams = self::TEST_PARAMS;
        $result = $this->givePointService->givePoint($testParams);
        $this->assertTrue($result);
    }

    /**
     * testGetGivePoint function
     * 贈ったポイント取得のテスト
     * @return void
     */
    public function testGetGivePoint(): void
    { 
        $result = $this->givePointService->getGivePoint();
        $this->assertEquals($result, 3000);
    }

    /**
     * testGetReceivePoint function
     * 貰ったポイント取得のテスト
     * @return void
     */
    public function testGetReceivePoint(): void
    {
        $result = $this->givePointService->getReceivePoint();
        $this->assertEquals($result, 4000);
    }

    /**
     * testValidateParams function
     * パラメータの検証のテスト
     * @return void
     */
    public function testValidateParams(): void
    {
        $testParams = self::TEST_PARAMS;
        $result = $this->givePointService->validateParams($testParams);
        $this->assertTrue($result);
    }

    /**
     * testValidateAvailablePoint function
     * 贈るポイントの検証のテスト
     * @return void
     */
    public function testValidateAvailablePoint(): void
    {
        $testGivePoint = 200;
        $result = $this->givePointService->validateAvailablePoint($testGivePoint);
        $this->assertTrue($result);

        $testGivePoint = 10000;
        $result = $this->givePointService->validateAvailablePoint($testGivePoint);
        $this->assertFalse($result);
    }

    /**
     * testValidateMessage function
     * メッセージの検証のテスト
     * @return void
     */
    public function testValidateMessage(): void
    {
        $testMessage = str_repeat('A', 30);
        $result = $this->givePointService->validateMessage($testMessage);
        $this->assertTrue($result);

        $testMessage = str_repeat('A', 31);
        $result = $this->givePointService->validateMessage($testMessage);
        $this->assertFalse($result);
    }
}
