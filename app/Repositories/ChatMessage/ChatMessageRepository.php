<?php

namespace App\Repositories\ChatMessage;

use App\Models\ChatMessage;

class ChatMessageRepository implements ChatMessageRepositoryInterface
{
    /**
     * ChatMessageRepository function
     *
     * @param ChatMessage $model
     */
    public function __construct(
        ChatMessage $model
    ) {
        $this->model = $model;
    }

    /**
     * getChatMessages function
     * チャットメッセージの一覧を取得
     * @param array $userIds
     * @return void
     */
    public function getChatMessages(array $userIds): object
    {
        return $this->model
                    ->whereIn('send_user_id', $userIds)
                    ->whereIn('receive_user_id', $userIds)
                    ->orderBy('id')
                    ->get();
    }

    /**
     * create function
     * 保存処理
     * @param array $params
     * @return object
     */
    public function create(array $params): object
    {
        return $this->model->create($params);
    }
}