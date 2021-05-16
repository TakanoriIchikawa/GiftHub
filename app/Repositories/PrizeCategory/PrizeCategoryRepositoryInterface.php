<?php

namespace App\Repositories\PrizeCategory;

interface PrizeCategoryRepositoryInterface
{
    /**
     * getPrizeCategories function
     * 景品のカテゴリ一覧を取得
     * @return object
     */
    public function getPrizeCategories(): object;
}