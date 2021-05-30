<?php

namespace App\Services;

use App\Repositories\GiftItem\GiftItemRepositoryInterface;

class GiftItemService
{
    /**
     * GiftItemService __construct
     *
     * @param GiftItemRepositoryInterface $giftItemRepository
     */
    public function __construct(
        GiftItemRepositoryInterface $giftItemRepository
    ) {
        $this->giftItemRepository = $giftItemRepository;
    }

    /**
     * getGiftItems function
     * 景品のー覧を取得
     * @param integer $giftCategoryId
     * @return object
     */
    public function getGiftItems(int $giftCategoryId): object
    {
        return $this->giftItemRepository->getGiftItems($giftCategoryId);
    }
}