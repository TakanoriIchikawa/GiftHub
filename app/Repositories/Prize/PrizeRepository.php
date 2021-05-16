<?php

namespace App\Repositories\Prize;

use App\Models\Prize;

class PrizeRepository implements PrizeRepositoryInterface
{
    /**
     * PrizeRepository __construct
     *
     * @param Prize $model
     */
    public function __construct(
        Prize $model
    ) {
        $this->model = $model;
    }

    /**
     * getPrizes function
     * 景品の一覧を取得
     * @param integer $prizeCategoryId
     * @return object
     */
    public function getPrizes(int $prizeCategoryId): object
    {
        return $this->model
                    ->where('prize_category_id', $prizeCategoryId)
                    ->get();
    }
}