<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * UserController __construct
     *
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    ) {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    /**
     * searchUsers function
     * ユーザー検索して一覧を取得、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function searchUsers(Request $request)
    {
        $userName = $request->user_name;
        $excludeFriends = $request->exclude_friends;
        $users = $this->userService->searchUsers($userName, $excludeFriends);
        return response()->json($users);
    }

    /**
     * findUser function
     * ユーザー情報を取得し、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function findUser(Request $request)
    {
        $userId = $request->user_id;
        $user = $this->userService->findUser($userId);
        return response()->json($user);
    }

    /**
     * updateProfile function
     * プロフィールを更新、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function updateProfile(Request $request)
    {
        $result = $this->userService->validateParams($request->all());
        if (!$result) {
            $message = '入力内容が正しくありません。';
            return response()->json(['message' => $message], 422);
        }

        $result = $this->userService->updateProfile($request);
        if (!$result) {
            $message = '更新処理に失敗しました。';
            return response()->json(['message' => $message], 500);
        }

        if ($request->file('image')) {
            $this->userService->uploadUserImage($request);
        }
        return response()->json([], 200);
    }
}
