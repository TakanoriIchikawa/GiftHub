<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * testRegisterApi function
     * ユーザー登録APIのテスト
     * @return void
     */
    public function testRegisterApi(): void
    {
        $data = [
            'name' => '市川千耀',
            'email' => 'chiaki0223@icloud.com',
            'password' => 'chiaki0223',
            'password_confirmation' => 'chiaki0223',
        ];

        $response = $this->json('POST', route('register'), $data);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);

        $response->assertStatus(201)
                ->assertJson(['name' => $user->name]);
    }
}
