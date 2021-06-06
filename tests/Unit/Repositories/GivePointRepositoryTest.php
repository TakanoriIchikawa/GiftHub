<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $this->givePointRepository = app(GivePointRepositoryInterface::class);
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
}
