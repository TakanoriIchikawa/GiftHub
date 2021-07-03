<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Friend\FriendRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class UserService
{
    const IMG_AVATARS = 'img/avatars/';
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

    /**
     * findUser function
     * ユーザー情報を取得
     * @param integer|null $userId
     * @return object
     */
    public function findUser(?int $userId = null): object
    {
        if (empty($userId)) {
            $userId = Auth::id();
        }
        return $this->userRepository->findUser($userId);
    }

    /**
     * validateParams function
     * パラメータの検証
     * @param array $params
     * @return boolean
     */
    public function validateParams(array $params): bool
    {
        if (!isset($params['name']) || !isset($params['name'])) {
            return false;
        }
        $name = $params['name'];
        $email = $params['email'];

        if (empty($name) || mb_strlen($name) > 100) {
            return false;
        } 

        if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        } 

        return true;
    }

    /**
     * updateProfile function
     * プロフィールを更新
     * @param array $params
     * @return boolean
     */
    public function updateProfile(array $params): bool
    {
        $user = $this->userRepository->findUser(Auth::id());
        $user->fill($params);
        \Log::debug($params);
        DB::beginTransaction();
        try {
            $this->userRepository->update($user);
            DB::commit();
        } catch (\Exception $e) {
            \Log::debug($e->getMessage());
            DB::rollback();
            return false;
        }

        return true;
    }

    /**
     * setUserImage function
     * 画像ファイルの保存設定
     * @param object $request
     * @return string 
     */
    public function setUserImage(object $request): string
    {
        $imagePath = self::IMG_AVATARS;
        $imageName = Auth::id() .'.' .$request->file('image')->getClientOriginalExtension();
        return Storage::disk('s3')->url($imagePath .$imageName);
    }

    /**
     * uploadUserImage function
     * ユーザー画像のアップロード
     * @param object $request
     * @return string 
     */
    public function uploadUserImage(object $request): string
    {
        $imageFile = $request->file('image');

        $imagePath = self::IMG_AVATARS;
        $imageName = Auth::id() .'.' .$imageFile->getClientOriginalExtension();

        Storage::disk('s3')->delete($imagePath .$imageName);
        return $imageFile->storeAs($imagePath, $imageName, ['disk' => 's3', 'visibility' => 'public']);
    }
}