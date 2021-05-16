<?php

namespace App\Services;

use App\Repositories\Prize\PrizeRepositoryInterface;

class PrizeService
{
    /**
     * PrizeService __construct
     *
     * @param PrizeRepositoryInterface $prizeRepository
     */
    public function __construct(
        PrizeRepositoryInterface $prizeRepository
    ) {
        $this->prizeRepository = $prizeRepository;
    }

    /**
     * getPrizes function
     * 景品のー覧を取得
     * @param integer $prizeCategoryId
     * @return array
     */
    public function getPrizes(int $prizeCategoryId): array
    {
        return $this->prizeRepository->getPrizes($prizeCategoryId)->toArray();
    }
}