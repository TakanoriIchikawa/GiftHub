<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExchangePointService;

class ExchangePointController extends Controller
{
    /**
     * ExchangePointController __construct
     *
     * @param ExchangePointService $exchangePointService
     */
    public function __construct(
        ExchangePointService $exchangePointService
    ) {
        $this->middleware('auth');
        $this->exchangePointService = $exchangePointService;
    }

    /**
     * getExchangeablePoint function
     * 交換可能なポイントを取得し、レスポンスを返す
     * @return json
     */
    public function getExchangeablePoint()
    {
        $exchangeablePoint = $this->exchangePointService->getExchangeablePoint();
        return response()->json($exchangeablePoint);
    }

    /**
     * exchangePoint function
     * ポイントと景品を交換し、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function exchangePoint(Request $request)
    {
        $params = $request->params;
        $exchangeablePoint = $this->exchangePointService->getExchangeablePoint();
        if ($params['exchange_point'] > $exchangeablePoint) {
            $message = 'ポイントが不足しています。';
            return response()->json(['message' => $message], 422);
        }

        $result = $this->exchangePointService->exchangePoint($params);

        return response()->json([], 200);
    }
}
