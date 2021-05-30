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
        $users = $this->userService->searchUsers($userName);
        return response()->json($users);
    }
}
