<?php

namespace App\Repositories\GivePoint;

interface GivePointRepositoryInterface
{
    /**
     * create function
     * 保存処理
     * @param array $params
     * @return object
     */
    public function create(array $params): object;

    /**
     * getGivePoints function
     * 贈ったポイントの一覧を取得
     * @return object
     */
    public function getGivePoints(): object;

    /**
     * getReceivePoints function
     * 貰ったポイントの一覧を取得
     * @return object
     */
    public function getReceivePoints(): object;
}