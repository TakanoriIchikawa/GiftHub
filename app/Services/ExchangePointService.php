<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GivePoint\GivePointRepositoryInterface;
use App\Repositories\ExchangePoint\ExchangePointRepositoryInterface;

class ExchangePointService
{
    /**
     * ExchangePointService __construct
     *
     * @param GivePointRepositoryInterface $givePointRepository
     * @param ExchangePointRepositoryInterface $exchangePointRepository
     */
    public function __construct(
        GivePointRepositoryInterface $givePointRepository,
        ExchangePointRepositoryInterface $exchangePointRepository
    ) {
        $this->givePointRepository = $givePointRepository;
        $this->exchangePointRepository = $exchangePointRepository;
    }

    /**
     * getExchangeablePoint function
     * 交換可能なポイントを取得
     * @return integer
     */
    public function getExchangeablePoint(): int
    {
        $receivePoints = $this->givePointRepository->getReceivePoints();
        $receivePoint = $receivePoints->sum('give_point');

        $exchangeGiftItems = $this->exchangePointRepository->getExchangeGiftItems();
        $exchangePoint = $exchangeGiftItems->sum('exchange_point');
        return $receivePoint - $exchangePoint;
    }

    /**
     * exchangePoint function
     * ポイントと景品を交換
     * @param array $params
     * @return boolean
     */
    public function exchangePoint(array $params): bool
    {
        $params['user_id'] = AUth::id();
        DB::beginTransaction();
        try {
            $this->exchangePointRepository->create($params);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }

        return true;
    }
}