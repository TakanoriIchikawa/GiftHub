<?php

namespace App\Repositories\GiftItem;

interface GiftItemRepositoryInterface
{
    /**
     * getGiftItems function
     * 景品の一覧を取得
     * @param integer $giftCategoryId
     * @return object
     */
    public function getGiftItems(int $giftCategoryId): object;
}