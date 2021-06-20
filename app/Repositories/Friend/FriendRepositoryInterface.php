<?php

namespace App\Repositories\Friend;

interface FriendRepositoryInterface
{
    /**
     * searchFriends function
     * 友達を名前であいまい検索
     * @param string|null $friendName
     * @return object
     */
    public function searchFriends(?string $friendName = null): object;

    /**
     * existsFriend function
     * 友達登録されているか確認
     * @param integer $userId
     * @param integer $friendUserId
     * @return boolean
     */
    public function existsFriend(int $userId, int $friendUserId): bool;

    /**
     * create function
     * 保存処理
     * @param array $params
     * @return object
     */
    public function create(array $params): object;

    /**
     * getFriendsWithLatestChatMessage function
     * 友達と最新のチャットメッセージを取得
     * @return object
     */
    public function getFriendsWithLatestChatMessage(): object;
}