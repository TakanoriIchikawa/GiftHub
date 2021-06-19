<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ChatMessageService;

class ChatMessageController extends Controller
{
    /**
     * ChatMessageController __construct
     *
     * @param ChatMessageService $chatMessageService
     */
    public function __construct(
        ChatMessageService $chatMessageService
    ) {
        $this->middleware('auth');
        $this->chatMessageService = $chatMessageService;
    }

    /**
     * getChats function
     * チャットの一覧を取得、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function getChats(Request $request)
    {
        $chats = $this->chatMessageService->getChats();
        return response()->json($chats);
    }

    /**
     * getChatMessages function
     * チャットメッセージの一覧を取得、レスポンスを返す
     * @param Request $request
     * @return void
     */
    public function getChatMessages(Request $request)
    {
        $receiveUserId = $request->receive_user_id;
        $chatMessages = $this->chatMessageService->getChatMessages($receiveUserId);
        return response()->json($chatMessages);
    }

    /**
     * sendChatMessage function
     * チャットメッセージを送信
     * @param Request $request
     * @return json
     */
    public function sendChatMessage(Request $request)
    {
        $params = $request->params;
        $result = $this->chatMessageService->sendChatMessage($params);
        if (!$result) {
            $message = '更新処理に失敗しました。';
            return response()->json(['message' => $message], 500);
        }

        return response()->json([], 200);
    }
}
