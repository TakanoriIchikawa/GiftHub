<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    /**
     * UserService __construct
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * searchUsers function
     * ユーザー検索して一覧を取得
     * @param string|null $userName
     * @return object
     */
    public function searchUsers(?string $userName): object
    {   
        return $this->userRepository->searchUsers($userName);
    }
}