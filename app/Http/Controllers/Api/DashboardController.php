<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        DashboardService $dashboardService
    ) {
        $this->middleware('auth');
        $this->dashboardService = $dashboardService;
    }

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
