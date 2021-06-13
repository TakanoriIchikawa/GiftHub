<?php

namespace App\Repositories\Friend;

use App\Models\Friend;
use Illuminate\Support\Facades\Auth;

class FriendRepository implements FriendRepositoryInterface
{
    /**
     * FriendRepository __construct
     *
     * @param Friend $model
     */
    public function __construct(
        Friend $model
    ) {
        $this->model = $model;
    }

    /**
     * searchFriends function
     * 友達を名前であいまい検索
     * @param string|null $friendName
     * @return object
     */
    public function searchFriends(?string $friendName = null): object
    {
        $query = $this->model->with(['user', 'givePoints']);
        if ($friendName) {
            $query->whereHas('user', function ($query) use ($friendName) {
                $query->where('name', 'like', "%$friendName%");
            });
        }

        $userId = Auth::id();
        return $query->where('user_id', $userId)
                    ->orderBy('id')
                    ->get();
    }

    /**
     * existsFriend function
     * 友達登録されているか確認
     * @param integer $friendUserId
     * @return boolean
     */
    public function existsFriend(int $friendUserId): bool
    {
        $userId = Auth::id();
        return $this->model
                    ->where('user_id', $userId)
                    ->where('friend_id', $friendUserId)
                    ->exists();
    }

    /**
     * create function
     * 保存処理
     * @param integer $friendUserId
     * @return object
     */
    public function create(int $friendUserId): object
    {
        $userId = Auth::id();
        $params = [
            'user_id' => $userId,
            'friend_id' => $friendUserId,
        ];

        return $this->model->create($params);
    }
}