<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GiftCategoryService;

class GiftCategoryController extends Controller
{
    /**
     * GiftCategoryController __construct
     * 
     * @param GiftCategoryService $giftCategoryService
     */
    public function __construct(
        GiftCategoryService $giftCategoryService
    ) {
        $this->middleware('auth');
        $this->giftCategoryService = $giftCategoryService;
    }

    /**
     * getGiftCategories function
     * 景品のカテゴリ一覧を取得、レスポンスを返す
     * @return json
     */
    public function getGiftCategories()
    {
        $giftCategories = $this->giftCategoryService->getGiftCategories();
        return response()->json($giftCategories);
    }
}
