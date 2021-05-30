<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    /**
     * UserRepository __construct
     *
     * @param User $model
     */
    public function __construct(
        User $model
    ) {
        $this->model = $model;
    }

    /**
     * searchUsers function
     * ユーザーを名前であいまい検索
     * 検索ワードが空であれば、ユーザーの一覧を取得（最大100件）
     * @param string|null $userName
     * @return object
     */
    public function searchUsers(?string $userName): object
    {
        $userId = Auth::id();
        if ($userName) {
            return $this->model
                        ->where('name', 'like', "%$userName%")
                        ->where('id', '!=', $userId)
                        ->orderBy('id')
                        ->get();
        }

        return $this->model
                    ->where('id', '!=', $userId)
                    ->orderBy('id')
                    ->limit(100)
                    ->get();
    }
}