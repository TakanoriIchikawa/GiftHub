<?php

namespace App\Repositories\ExchangePoint;

use Illuminate\Support\Facades\Auth;
use App\Models\ExchangePoint;

class ExchangePointRepository implements ExchangePointRepositoryInterface
{
    /**
     * ExchangePointRepository __construct
     *
     * @param ExchangePoint $model
     */
    public function __construct(
        ExchangePoint $model
    ) {
        $this->model = $model;
    }

    /**
     * getExchangeGiftItems function
     * ポイントと交換した景品一覧を取得
     * @return object
     */
    public function getExchangeGiftItems(): object
    {
        $userId = Auth::id();
        return $this->model
                    ->with('giftItem')
                    ->where('user_id', $userId)
                    ->get();
    }

    /**
     * create function
     * 保存処理
     * @param array $params
     * @return object
     */
    public function create(array $params): object
    {
        return $this->model->create($params);
    }
}