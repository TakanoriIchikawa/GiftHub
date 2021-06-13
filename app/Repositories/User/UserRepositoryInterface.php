<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * searchUsers function
     * ユーザーを名前であいまい検索
     * 検索ワードが空であれば、ユーザーの一覧を取得（最大100件）
     * 友達を（含む/除く）検索
     * @param string|null $userName
     * @param array $excludeFriendIds
     * @return object
     */
    public function searchUsers(?string $userName = null, ?array $excludeFriendIds = []): object;
}