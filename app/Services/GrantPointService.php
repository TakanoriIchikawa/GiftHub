<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

    /**
     * chargeGrantPoint function
     * ポイントのチャージ
     * @param array $params
     * @return void
     */
    public function chargeGrantPoint(array $params)
    {
        $params['user_id'] = Auth::id();
        $params['available_point'] = $params['grant_point'];
        $date = new Carbon;
        $params['expiration_date'] = $date->addMonth(2)->format('Y-m-d');
        return $this->grantPointRepository->create($params);
    }
}