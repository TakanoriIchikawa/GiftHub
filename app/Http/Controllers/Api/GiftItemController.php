<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GiftItemService;

class GiftItemController extends Controller
{
    /**
     * GiftItemController __construct
     *
     * @param GiftItemService $giftItemService
     */
    public function __construct(
        GiftItemService $giftItemService
    ) {
        $this->middleware('auth');
        $this->giftItemService = $giftItemService;
    }

    /**
     * getGiftItems function
     * 景品の一覧を取得、レスポンスを返す
     * @param Request $request
     * @return json
     */
    public function getGiftItems(Request $request)
    {
        $giftCategoryId = (int) $request->gift_category_id;
        $giftItems = $this->giftItemService->getGiftItems($giftCategoryId);
        return response()->json($giftItems);
    }
}
