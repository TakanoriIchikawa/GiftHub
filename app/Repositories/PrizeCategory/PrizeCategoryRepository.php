<?php

namespace App\Repositories\PrizeCategory;

use App\Models\PrizeCategory;

class PrizeCategoryRepository implements PrizeCategoryRepositoryInterface
{
    /**
     * PrizeCategoryRepository __construct
     *
     * @param PrizeCategory $model
     */
    public function __construct(
        PrizeCategory $model
    ) {
        $this->model = $model;
    }

    /**
     * getPrizeCategories function
     * 景品のカテゴリ一覧を取得
     * @return object
     */
    public function getPrizeCategories(): object
    {
        return $this->model->get();
    }
}