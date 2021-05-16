<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PrizeService;

class PrizeController extends Controller
{
    /**
     * PrizeController __construct
     *
     * @param PrizeService $prizeService
     */
    public function __construct(
        PrizeService $prizeService
    ) {
        $this->middleware('auth');
        $this->prizeService = $prizeService;
    }

    /**
     * getPrizes function
     * 景品の一覧を取得、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function getPrizes(Request $request)
    {
        $prizeCategoryId = (int) $request->prize_category_id;
        $prizes = $this->prizeService->getPrizes($prizeCategoryId);
        return response()->json($prizes);
    }
}
