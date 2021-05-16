<?php

namespace App\Services;

use App\Repositories\PrizeCategory\PrizeCategoryRepositoryInterface;

class PrizeCategoryService
{
    /**
     * PrizeCategoryService __construct
     *
     * @param PrizeCategoryRepositoryInterface $prizeCategoryRepository
     */
    public function __construct(
        PrizeCategoryRepositoryInterface $prizeCategoryRepository
    ) {
        $this->prizeCategoryRepository = $prizeCategoryRepository;
    }

    /**
     * getPrizeCategories function
     * 景品のカテゴリ一覧を取得
     * @return array
     */
    public function getPrizeCategories(): array
    {
        return $this->prizeCategoryRepository->getPrizeCategories()->toArray();
    }
}