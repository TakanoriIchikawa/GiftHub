<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GrantPointService;

class GrantPointController extends Controller
{
    /**
     * GrantPointController __construct
     *
     * @param GrantPointService $grantPointService
     */
    public function __construct(
        GrantPointService $grantPointService
    ) {
        $this->middleware('auth');
        $this->grantPointService = $grantPointService;
    }

    /**
     * getAvailablePoint function
     * 利用可能なポイントを取得、レスポンスを返す
     * @return json
     */
    public function getAvailablePoint()
    {
        $availablePoint = $this->grantPointService->getAvailablePoint();
        return response()->json($availablePoint);
    }

    /**
     * chargeGrantPoint function
     * ポイントのチャージ
     * @param Request $request
     * @return void
     */
    public function chargeGrantPoint(Request $request)
    {
        $params = $request->params;
        $result = $this->grantPointService->chargeGrantPoint($params);
        if (!$result) {
            $message = '更新処理に失敗しました。';
            return response()->json(['message' => $message], 500);
        }

        $availablePoint = $this->grantPointService->getAvailablePoint();
        return response()->json($availablePoint);
    }
}
