<?php

namespace App\Services;

use App\Repositories\GiftCategory\GiftCategoryRepositoryInterface;

class GiftCategoryService
{
    /**
     * GiftCategoryService __construct
     *
     * @param GiftCategoryRepositoryInterface $giftCategoryRepository
     */
    public function __construct(
        GiftCategoryRepositoryInterface $giftCategoryRepository
    ) {
        $this->giftCategoryRepository = $giftCategoryRepository;
    }

    /**
     * getGiftCategories function
     * 景品のカテゴリ一覧を取得
     * @return object
     */
    public function getGiftCategories(): object
    {
        return $this->giftCategoryRepository->getGiftCategories();
    }
}