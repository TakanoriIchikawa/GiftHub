<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * searchUsers function
     * ユーザーを名前であいまい検索
     * 検索ワードが空であれば、ユーザーの一覧を取得（最大100件）
     * @param string|null $userName
     * @return object
     */
    public function searchUsers(?string $userName): object;
}