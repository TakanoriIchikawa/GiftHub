<?php

namespace App\Repositories\GiftCategory;

use App\Models\GiftCategory;

class GiftCategoryRepository implements GiftCategoryRepositoryInterface
{
    /**
     * GiftCategoryRepository __construct
     *
     * @param GiftCategory $model
     */
    public function __construct(
        GiftCategory $model
    ) {
        $this->model = $model;
    }

    /**
     * getGiftCategories function
     * 景品のカテゴリ一覧を取得
     * @return object
     */
    public function getGiftCategories(): object
    {
        return $this->model->get();
    }
}