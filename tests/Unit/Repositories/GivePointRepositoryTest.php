<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GivePoint\GivePointRepositoryInterface;
use Tests\TestCase;

class GivePointRepositoryTest extends TestCase
{
    use RefreshDatabase;

    const TEST_PARAMS = [
        'give_user_id' => 1,
        'receive_user_id' => 2,
        'give_point' => 200,
        'signature' => true,
        'message' => 'テストです。',
    ];

    public function setup(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestGivePoints($this->user->id);
        $this->givePointRepository = app(GivePointRepositoryInterface::class);
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
    }

    /**
     * testCreate function
     * 保存処理のテスト
     * @return void
     */
    public function testCreate(): void
    {
        $testParams = self::TEST_PARAMS;
        $createData = $this->givePointRepository->create($testParams);

        $result = false;
        if ($createData->give_point === $testParams['give_point']) {
            $result = true;
        }

        $this->assertTrue($result);
    }

    /**
     * testGetGivePoints function
     * 贈ったポイントの一覧取得のテスト
     * @return void
     */
    public function testGetGivePoints(): void
    {
        $givePoints = $this->givePointRepository->getGivePoints();
        $result = $givePoints->where('give_point', 2000)->isNotEmpty();
        $this->assertTrue($result);
    }

    /**
     * testGetReceivePoints function
     * 貰ったポイントの一覧取得のテスト
     * @return void
     */
    public function testGetReceivePoints()
    {
        $receivePoints = $this->givePointRepository->getReceivePoints();
        $result = $receivePoints->where('give_point', 2000)->isNotEmpty();
        $this->assertTrue($result);
    }
}
