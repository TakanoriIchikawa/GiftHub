<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FriendService;

class FriendController extends Controller
{
    /**
     * FriendController __construct
     *
     * @param FriendService $friendService
     */
    public function __construct(
        FriendService $friendService
    ) {
        $this->middleware('auth');
        $this->friendService = $friendService;
    }

    /**
     * searchFriends function
     * 友達を検索して一覧を取得、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function searchFriends(Request $request)
    {
        $friendName = $request->friend_name;
        $friends = $this->friendService->searchFriends($friendName);
        return response()->json($friends);
    }

    /**
     * addFriend function
     * 友達を追加
     * @param Request $request
     * @return json
     */
    public function addFriend(Request $request)
    {
        $friendUserId = $request->params['friend_user_id'];
        $result = $this->friendService->existsFriend($friendUserId);
        if ($result) {
            return response()->json([], 200);
        }

        $result = $this->friendService->addFriend($friendUserId);
        if (!$result) {
            $message = '更新処理に失敗しました。';
            return response()->json(['message' => $message], 500);
        }

        return response()->json([], 200);
    }
}
