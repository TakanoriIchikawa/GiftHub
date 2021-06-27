<?php

namespace App\Services;

use App\Services\GrantPointService;
use App\Services\GivePointService;
use App\Services\ExchangePointService;
use App\Repositories\GivePoint\GivePointRepositoryInterface;
use App\Repositories\ExchangePoint\ExchangePointRepositoryInterface;

class DashboardService
{
    /**
     * DashboardService __construct
     *
     * @param GrantPointService $grantPointService
     * @param GivePointService $givePointService
     * @param ExchangePointService $exchangePointService
     * @param GivePointRepositoryInterface $givePointRepository
     * @param ExchangePointRepositoryInterface $exchangePointRepository
     */
    public function __construct(
        GrantPointService $grantPointService,
        GivePointService $givePointService,
        ExchangePointService $exchangePointService,
        GivePointRepositoryInterface $givePointRepository,
        ExchangePointRepositoryInterface $exchangePointRepository
    ) {
        $this->grantPointService = $grantPointService;
        $this->givePointService = $givePointService;
        $this->exchangePointService = $exchangePointService;
        $this->givePointRepository = $givePointRepository;
        $this->exchangePointRepository = $exchangePointRepository;
    }

    /**
     * getDashboardPoints function
     * 各ポイントの一覧を取得
     * @return array
     */
    public function getDashboardPoints(): array
    {
        $availablePoint = $this->grantPointService->getAvailablePoint();
        $gavePoint = $this->givePointService->getGivePoint();
        $receivedPoint = $this->givePointService->getReceivePoint();
        $exchangeablePoint = $this->exchangePointService->getExchangeablePoint();

        $points = [
            'available_point' => $availablePoint,
            'gave_point' => $gavePoint,
            'received_point' => $receivedPoint,
            'exchangeable_point' => $exchangeablePoint,
        ];
        return $points;
    }

    /**
     * getDashboardList function
     * 直近の各やりとりを取得
     * @return array
     */
    public function getDashboardList(): array
    {
        $givePoints = $this->givePointRepository->getGivePoints()->sortByDesc('id')->take(5);
        $receivePoints = $this->givePointRepository->getReceivePoints()->sortByDesc('id')->take(5);
        $exchangeGiftItems = $this->exchangePointRepository->getExchangeGiftItems()->sortByDesc('id')->take(5);

        $list = [
            'give_point_friends' => $givePoints,
            'receive_point_friends' => $receivePoints,
            'exchange_gift_items' => $exchangeGiftItems,
        ];
        return $list;
    }
}