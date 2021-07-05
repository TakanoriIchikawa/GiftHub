<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GrantPointControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestGrantPoints($this->user->id);
        Auth::attempt(['email' => 'chiaki0223@test.com', 'password' => 'chiaki0223']);
    }

    /**
     * testGetAvailablePoint function
     * 利用可能なポイント取得APIのテスト
     * @return void
     */
    public function testGetAvailablePoint(): void
    {
        $response = $this->json('GET', route('get.available.point'));
        $response->assertStatus(200);
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
        $response = $this->json('POST', route('charge.grant.point'), ['params' => $params]);
        $response->assertStatus(200);
    }
}
