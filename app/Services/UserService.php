<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Friend\FriendRepositoryInterface;

class UserService
{
    /**
     * UserService __construct
     *
     * @param UserRepositoryInterface $userRepository
     * @param FriendRepositoryInterface $friendRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        FriendRepositoryInterface $friendRepository
    ) {
        $this->userRepository = $userRepository;
        $this->friendRepository = $friendRepository;
    }

    /**
     * searchUsers function
     * ユーザー検索して一覧を取得
     * 友達を（含む/除く）検索
     * @param string|null $userName
     * @param boolean $excludeFriends
     * @return object
     */
    public function searchUsers(?string $userName, ?bool $excludeFriends = false): object
    {   
        $excludeFriendIds = [];
        if ($excludeFriends) {
            $friends = $this->friendRepository->searchFriends();
            $excludeFriendIds = $friends->pluck('friend_id')->toArray();
        }
        return $this->userRepository->searchUsers($userName, $excludeFriendIds);
    }

    public function findUser($userId)
    {
        return $this->userRepository->findUser($userId);
    }
}