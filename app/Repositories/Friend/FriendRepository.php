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
     * @param integer $userId
     * @param integer $friendUserId
     * @return boolean
     */
    public function existsFriend(int $userId, int $friendUserId): bool
    {
        return $this->model
                    ->where('user_id', $userId)
                    ->where('friend_id', $friendUserId)
                    ->exists();
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

    /**
     * getFriendsWithLatestChatMessage function
     * 友達と最新のチャットメッセージを取得
     * @return object
     */
    public function getFriendsWithLatestChatMessage(): object
    {
        $userId = Auth::id();
        return $this->model
                    ->with(['user', 'latestSendChatMessage', 'latestReceiveChatMessage'])
                    ->where('user_id', $userId)
                    ->get();
    }
}