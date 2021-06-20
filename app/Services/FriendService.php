<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Friend\FriendRepositoryInterface;

class FriendService
{
    /**
     * FriendService __construct
     *
     * @param FriendRepositoryInterface $friendRepository
     */
    public function __construct(
        FriendRepositoryInterface $friendRepository
    ) {
        $this->friendRepository = $friendRepository;
    }

    /**
     * searchFriends function
     * 友達を検索して一覧を取得
     * 贈ったポイントの多い順に並び替え
     * @param string|null $friendName
     * @return object
     */
    public function searchFriends(?string $friendName): object
    {
        $friends = $this->friendRepository->searchFriends($friendName);
        $userId = Auth::id();
        foreach ($friends as $friend) {
            $friend->sum_give_points = $friend->givePoints->where('give_user_id', $userId)->sum('give_point');
        }

        return $friends->sortByDesc('sum_give_points')->values();
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
        return $this->friendRepository->existsFriend($userId, $friendUserId);
    }

    /**
     * addFriend function
     * 友達に追加
     * @param integer $friendUserId
     * @return boolean
     */
    public function addFriend(int $friendUserId): bool
    {
        $params = [
            'user_id' => Auth::id(),
            'friend_id' => $friendUserId,
        ];
        DB::beginTransaction();
        try {
            $this->friendRepository->create($params);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }

        return true;
    }
}