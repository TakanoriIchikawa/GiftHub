<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GrantPoint\GrantPointRepositoryInterface;
use Carbon\Carbon;
use Tests\TestCase;

class GrantPointRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestGrantPoints($this->user->id);
        $this->grantPointRepository = app(GrantPointRepositoryInterface::class);
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetAvailablePoint function
     * 利用可能なポイントを取得のテスト
     * @return void
     */
    public function testGetAvailablePoint(): void
    {
        $grantPoints = $this->grantPointRepository->getAvailablePoints();

        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');

        $result = $grantPoints->where('expiration_date', $yesterday)->isEmpty();
        $this->assertTrue($result);

        $result = $grantPoints->where('expiration_date', $today)->isNotEmpty();
        $this->assertTrue($result);

        $result = $grantPoints->sum('available_point');
        $this->assertSame($result, 2500);
    }

    /**
     * testCreate function
     * 保存処理のテスト
     * @return void
     */
    public function testCreate()
    {
        $date = new Carbon;
        $expirationDate = $date->addMonth(2)->format('Y-m-d');

        $params = [
            'user_id' => $this->user->id,
            'grant_point' => 1000,
            'available_point' => 1000,
            'expiration_date' => $expirationDate
        ];
        $result = $this->grantPointRepository->create($params);
        $this->assertEquals($result->user_id, $this->user->id);
        $this->assertEquals($result->grant_point, 1000);
        $this->assertEquals($result->available_point, 1000);

        $date = new Carbon;
        $expirationDate = $date->addMonth(2)->format('Y-m-d');
        $this->assertEquals($result->expiration_date, $expirationDate);
    }

    /**
     * testUpdate function
     * 更新処理のテスト
     * @return void
     */
    public function testUpdate(): void
    {
        $grantPoints = $this->grantPointRepository->getAvailablePoints();
        $grantPoint = $grantPoints->first();

        $testUpdateData = [
            'id' => $grantPoint->id,
            'available_point' => 200,
        ];
        
        $result = $this->grantPointRepository->update($testUpdateData);
        $this->assertSame($result, 1);

        $grantPoints = $this->grantPointRepository->getAvailablePoints();
        $grantPoint = $grantPoints->first();

        $result = false;
        if ($grantPoint->available_point === 200) {
            $result = true;
        }
        $this->assertTrue($result);
    }
}
