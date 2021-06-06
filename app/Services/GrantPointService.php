<?php

namespace App\Services;

use App\Repositories\GrantPoint\GrantPointRepositoryInterface;

class GrantPointService
{
    /**
     * GrantPointService __construct
     *
     * @param GrantPointRepositoryInterface $grantPointRepository
     */
    public function __construct(
        GrantPointRepositoryInterface $grantPointRepository
    ) {
        $this->grantPointRepository = $grantPointRepository;
    }

    /**
     * getAvailablePoint function
     * 利用可能なポイントを取得、合計値を算出
     * @return integer
     */
    public function getAvailablePoint(): int
    {
        $availablePoints = $this->grantPointRepository->getAvailablePoints();
        return $availablePoints->sum('available_point');
    }
}