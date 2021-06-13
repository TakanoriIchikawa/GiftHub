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
     * @param integer $friendUserId
     * @return boolean
     */
    public function existsFriend(int $friendUserId): bool;

    /**
     * create function
     * 保存処理
     * @param integer $friendUserId
     * @return object
     */
    public function create(int $friendUserId): object;
}