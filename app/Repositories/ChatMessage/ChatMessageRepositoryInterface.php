<?php

namespace App\Repositories\ChatMessage;

interface ChatMessageRepositoryInterface
{
    /**
     * getChatMessages function
     * チャットメッセージの一覧を取得
     * @param array $userIds
     * @return void
     */
    public function getChatMessages(array $userIds): object;

    /**
     * create function
     * 保存処理
     * @param array $params
     * @return object
     */
    public function create(array $params): object;
}