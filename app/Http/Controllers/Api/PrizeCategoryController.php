<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PrizeCategoryService;

class PrizeCategoryController extends Controller
{
    /**
     * PrizeCategoryController __construct
     * 
     * @param PrizeCategoryService $prizeCategoryService
     */
    public function __construct(
        PrizeCategoryService $prizeCategoryService
    ) {
        $this->middleware('auth');
        $this->prizeCategoryService = $prizeCategoryService;
    }

    /**
     * getPrizeCategories function
     * 景品のカテゴリ一覧を取得、レスポンスを返す
     * @return json
     */
    public function getPrizeCategories()
    {
        $prizeCategories = $this->prizeCategoryService->getPrizeCategories();
        return response()->json($prizeCategories);
    }
}
