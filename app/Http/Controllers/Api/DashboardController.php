<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    /**
     * DashboardController __construct
     *
     * @param DashboardService $dashboardService
     */
    public function __construct(
        DashboardService $dashboardService
    ) {
        $this->middleware('auth');
        $this->dashboardService = $dashboardService;
    }

    /**
     * getDashboardData function
     * ダッシュボードに表示するデータを取得、レスポンスを返す
     * @return json
     */
    public function getDashboardData()
    {
        $points = $this->dashboardService->getDashboardPoints();
        $list = $this->dashboardService->getDashboardList();
        $dashboardData = [
            'points' => $points,
            'list' => $list,
        ];

        return response()->json($dashboardData);
    }
}
