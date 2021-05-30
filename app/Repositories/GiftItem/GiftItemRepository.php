<?php

namespace App\Repositories\GiftItem;

use App\Models\GiftItem;

class GiftItemRepository implements GiftItemRepositoryInterface
{
    /**
     * GiftItemRepository __construct
     *
     * @param GiftItem $model
     */
    public function __construct(
        GiftItem $model
    ) {
        $this->model = $model;
    }

    /**
     * getGiftItems function
     * 景品の一覧を取得
     * @param integer $giftCategoryId
     * @return object
     */
    public function getGiftItems(int $giftCategoryId): object
    {
        return $this->model
                    ->where('gift_category_id', $giftCategoryId)
                    ->get();
    }
}