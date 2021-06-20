<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Friend\FriendRepositoryInterface;
use App\Repositories\ChatMessage\ChatMessageRepositoryInterface;

class ChatMessageService
{
    /**
     * ChatMessageService __construct
     *
     * @param FriendRepositoryInterface $friendRepository
     * @param ChatMessageRepositoryInterface $chatMessageRepository
     */
    public function __construct(
        FriendRepositoryInterface $friendRepository,
        ChatMessageRepositoryInterface $chatMessageRepository
    ) {
        $this->friendRepository = $friendRepository;
        $this->chatMessageRepository = $chatMessageRepository;
    }

    /**
     * getChats function
     * チャットをした友達の一覧を取得
     * @return object
     */
    public function getChats(): object
    {
        $friendsWithLatestChatMessage = $this->friendRepository->getFriendsWithLatestChatMessage();
        foreach ($friendsWithLatestChatMessage as $key => $friend) {
            $latestSendChatMessage = $friend->latestSendChatMessage;
            $latestReceiveChatMessage = $friend->latestReceiveChatMessage;

            if (empty($latestSendChatMessage) && empty($latestReceiveChatMessage)) {
                $friendsWithLatestChatMessage->forget($key);
                continue;
            }

            if ($latestSendChatMessage['id'] < $latestReceiveChatMessage['id']) {
                $friend = $this->setLatestChatMessage($friend, $latestReceiveChatMessage);
            } else {
                $friend = $this->setLatestChatMessage($friend, $latestSendChatMessage);
            }
        }
        $chats = $friendsWithLatestChatMessage->sortByDesc('sort_id')->values();
        return $chats;
    }

    /**
     * setLatestChatMessage function
     * 最新のチャットメッセージを設定
     * @param object $friend
     * @param object $latestChatMessage
     * @return object
     */
    private function setLatestChatMessage(object $friend, object $latestChatMessage): object
    {
        $friend->sort_id = $latestChatMessage['id'];
        $friend->latest_chat_message = $latestChatMessage['message'];
        $date = new Carbon($latestChatMessage['created_at']);
        $friend->latest_chat_message_date = $date->format('Y年m月d日');
        return $friend;
    }

    /**
     * getChatMessages function
     * チャットメッセージの一覧を取得
     * @param integer $receiveUserId
     * @return object
     */
    public function getChatMessages(int $receiveUserId): object
    {
        $userIds = [
            Auth::id(),
            $receiveUserId
        ];
        return $this->chatMessageRepository->getChatMessages($userIds);
    }

    /**
     * sendChatMessage function
     * チャットメッセージを送信
     * ※友達登録されてなければ友達に追加
     * @param array $params
     * @return boolean
     */
    public function sendChatMessage(array $params): bool
    {
        $userId = Auth::id();
        $receiveUserId = $params['receive_user_id'];
        $params['send_user_id'] = $userId;
        DB::beginTransaction();
        try {
            $result = $this->friendRepository->existsFriend($receiveUserId , $userId);
            if (!$result) {
                $friendParams = [
                    'user_id' => $receiveUserId,
                    'friend_id' => $userId,
                ];
                $this->friendRepository->create($friendParams);
            }

            $this->chatMessageRepository->create($params);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
        return true;
    }
}