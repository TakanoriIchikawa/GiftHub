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
}
