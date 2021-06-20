<?php

namespace Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Services\ChatMessageService;
use Tests\TestCase;

class ChatMessageServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->user = $this->getTestUser('chiaki');
        $this->createTestFriends($this->user->id);
        $this->createTestChatMessages($this->user->id);
        $this->chatMessageService = app(ChatMessageService::class);
    }

    /**
     * testGetChats function
     * チャットをした友達の一覧取得のテスト
     * @return void
     */
    public function testGetChats() {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        $chats = $this->chatMessageService->getChats();
        foreach ($chats as $chat) {
            if (isset($sortId)) {
                $this->assertGreaterThan($chat->sort_id, $sortId);
            }
            $sortId = $chat->sort_id;
            
            $result = false;
            if (!empty($chat->latest_chat_message)) {
                $result = true;
            }

            $result = false;
            if (!empty($chat->latest_chat_message_date)) {
                $result = true;
            }
        }
    }

    /**
     * testGetChatMessages function
     * チャットメッセージの一覧取得のテスト
     * @return void
     */
    public function testGetChatMessages()
    {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        $friend = $this->getTestFriends($this->user->id)->first();
        $chatMessages = $this->chatMessageService->getChatMessages($friend->friend_id);
        foreach ($chatMessages as $chatMessage) {
            $result = false;
            if (!empty($chatMessage->message)) {
                $result = true;
            }
            $this->assertTrue($result);
        }
    }

    /**
     * testSendChatMessage function
     * チャットメッセージ送信のテスト
     * @return void
     */
    public function testSendChatMessage()
    {
        Auth::attempt(['login_id' => 'chiaki', 'password' => 'chiaki0223']);
        $params = [
            'receive_user_id' => 100,
            'message' => 'テストメッセージ',
        ];
        $result = $this->chatMessageService->sendChatMessage($params);
        $this->assertTrue($result);
    }
}
