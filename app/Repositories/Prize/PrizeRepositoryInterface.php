<?php

namespace App\Repositories\Prize;

interface PrizeRepositoryInterface
{
    /**
     * getPrizes function
     * 景品の一覧を取得
     * @param integer $prizeCategoryId
     * @return object
     */
    public function getPrizes(int $prizeCategoryId): object;
}