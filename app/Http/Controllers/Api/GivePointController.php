<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GivePointService;
use App\Services\ChatMessageService;

class GivePointController extends Controller
{
    /**
     * GivePointController __construct
     *
     * @param GivePointService $givePointService
     * @param ChatMessageService $chatMessageService
     */
    public function __construct(
        GivePointService $givePointService,
        ChatMessageService $chatMessageService
    ) {
        $this->middleware('auth');
        $this->givePointService = $givePointService;
        $this->chatMessageService = $chatMessageService;
    }

    /**
     * givePoint function
     * パラメータの検証、ポイントを贈る、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function givePoint(Request $request)
    {
        $params = $request->params;
        $result = $this->givePointService->validateParams($params);
        if (!$result) {
            $message = '入力内容が正しくありません。';
            return response()->json(['message' => $message], 422);
        }
        
        $result = $this->givePointService->givePoint($params);
        if (!$result) {
            $message = '更新処理に失敗しました。';
            return response()->json(['message' => $message], 500);
        }
        
        if ($params['signature']) {
            if (!empty($params['message'])) {
                $this->chatMessageService->sendChatMessage($params);
            }
            $params['message'] = $params['give_point'] .'pt';
            $this->chatMessageService->sendChatMessage($params);
        }

        return response()->json([], 200);
    }
}
