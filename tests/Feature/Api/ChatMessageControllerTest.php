<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ChatMessageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->seed('FriendsTableSeeder');
        $this->seed('ChatMessagesTableSeeder');
    }

    /**
     * testGetChats function
     * チャット一覧取得APIのテスト
     * @return void
     */
    public function testGetChats()
    {
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
        $response = $this->json('GET', route('get.chats'));
        $response->assertStatus(200);
    }

    /**
     * testGetChatMessages function
     * チャットメッセージ一覧取得APIのテスト
     * @return void
     */
    public function testGetChatMessages()
    {
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
        $response = $this->json('GET', route('get.chat.messages'), ['receive_user_id' => 2]);
        $response->assertStatus(200);
    }

    /**
     * sendChatMessage function
     * チャットメッセージ送信APIのテスト
     * @return void
     */
    public function sendChatMessage()
    {
        Auth::attempt(['email' => 'chiaki0223@icloud.com', 'password' => 'chiaki0223']);
        $params = [
            'receive_user_id' => 2,
            'message' => 'テストメッセージ',
        ];
        $response = $this->json('POST', route('send.chat.message'), ['params' => $params]);
        $response->assertStatus(200);
    }
}
