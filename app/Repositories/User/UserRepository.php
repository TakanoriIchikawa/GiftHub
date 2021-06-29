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
     * 友達を（含む/除く）検索
     * @param string|null $userName
     * @param array $excludeFriendIds
     * @return object
     */
    public function searchUsers(?string $userName = null, ?array $excludeFriendIds = []): object
    {
        $userId = Auth::id();
        $query = $this->model->where('id', '!=', $userId);

        if ($userName) {
            $query->where('name', 'like', "%$userName%");
        } else {
            $query->limit(100);
        }

        if ($excludeFriendIds) {
            $query->whereNotIn('id', $excludeFriendIds);
        }
        
        return $query->orderBy('id')
                    ->get();
    }

    /**
     * findUser function
     * ユーザー情報を1件取得
     * @param integer
     * @return object
     */
    public function findUser(int $userId): object
    {
        return $this->model->find($userId);
    }

    /**
     * update function
     * 更新処理
     * @param object
     * @return boolean
     */
    public function update($user): bool
    {
        return $user->save();
    }
}