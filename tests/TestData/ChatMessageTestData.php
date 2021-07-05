<?php

namespace Tests\TestData;

use App\Models\ChatMessage;
use App\Models\Friend;

trait ChatMessageTestData
{
    /**
     * createTestChatMessages function
     * テスト用のチャットメッセージを作成
     * @param integer $userId
     * @return void
     */
    public function createTestChatMessages(int $userId): void
    {
        $friends = Friend::where('user_id', $userId)
                        ->orderBy('id')
                        ->get();

        foreach ($friends as $friend) {
            $data = [
                'send_user_id' => $userId,
                'receive_user_id' => $friend->friend_id,
                'message' => 'テスト送信メッセージ',
            ];
            ChatMessage::create($data);

            $data = [
                'send_user_id' => $friend->friend_id,
                'receive_user_id' => $userId,
                'message' => 'テスト受信メッセージ',
            ];
            ChatMessage::create($data);
        }
    }

}