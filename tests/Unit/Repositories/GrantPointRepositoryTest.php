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
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
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
