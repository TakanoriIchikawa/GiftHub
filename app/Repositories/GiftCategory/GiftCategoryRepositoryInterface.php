<?php

namespace App\Repositories\GiftCategory;

interface GiftCategoryRepositoryInterface
{
    /**
     * getGiftCategories function
     * 景品のカテゴリ一覧を取得
     * @return object
     */
    public function getGiftCategories(): object;
}