<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\ChatMessage\ChatMessageRepositoryInterface;
use Tests\TestCase;

class ChatMessageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->user = $this->getTestUser('chiaki');
        $this->createTestFriends($this->user->id);
        $this->createTestChatMessages($this->user->id);
        $this->chatMessageRepository = app(ChatMessageRepositoryInterface::class);
    }

    /**
     * testGetChatMessages function
     * チャットメッセージの一覧取得のテスト
     * @return void
     */
    public function testGetChatMessages()
    {
        $friend = $this->getTestFriends($this->user->id)->first();
        $userIds = [
            'user_id' => $this->user->id,
            'receive_user_id' => $friend->friend_id,
        ];

        $chatMessages = $this->chatMessageRepository->getChatMessages($userIds);
        foreach ($chatMessages as $chatMessage) {
            $result = false;
            if (!empty($chatMessage->message)) {
                $result = true;
            }
            $this->assertTrue($result);
        }
    }

    /**
     * testCreate function
     * 保存処理のテスト
     * @return void
     */
    public function testCreate()
    {
        $sendUserId = $this->user->id;
        $friend = $this->getTestFriends($this->user->id)->first();
        $receiveUserId = $friend->friend_id;
        $params = [
            'send_user_id' => $sendUserId,
            'receive_user_id' => $receiveUserId,
            'message' => 'テストメッセージ',
        ];
        $result = $this->chatMessageRepository->create($params);

        $this->assertEquals($result->send_user_id, $sendUserId);
        $this->assertEquals($result->receive_user_id, $receiveUserId);
        $this->assertEquals($result->message, 'テストメッセージ');
    }
}
