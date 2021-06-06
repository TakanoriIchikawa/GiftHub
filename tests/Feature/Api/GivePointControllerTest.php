<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GivePointControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createTestUser();
        $this->createTestGrantPoints($this->user->id);
    }

    /**
     * testGivePoint function
     * パラメータの検証、ポイントを贈るAPIのテスト
     * @return void
     */
    public function testGivePoint(): void
    {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        $params = [
            'receive_user_id' => 2,
            'give_point' => 200,
            'signature' => true,
            'message' => 'テストです。',
        ];
        $response = $this->json('POST', route('give.point'), ['params' => $params]);
        $response->assertStatus(200);
    }
}
