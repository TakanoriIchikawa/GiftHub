<?php

namespace App\Repositories\ExchangePoint;

interface ExchangePointRepositoryInterface
{
    /**
     * getExchangeGiftItems function
     * ポイントと交換した景品一覧を取得
     * @return object
     */
    public function getExchangeGiftItems(): object;

    /**
     * create function
     * 保存処理
     * @param array $params
     * @return object
     */
    public function create(array $params): object;
}