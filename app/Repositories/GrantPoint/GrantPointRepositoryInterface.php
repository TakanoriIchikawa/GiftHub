<?php

namespace App\Repositories\GrantPoint;

interface GrantPointRepositoryInterface
{
    /**
     * getAvailablePoints function
     * 利用可能なポイントを取得
     * @return object
     */
    public function getAvailablePoints(): object;

    /**
     * create function
     * 保存処理
     * @param array $params
     * @return object
     */
    public function create(array $params): object;

    /**
     * update function
     * 更新処理
     * @param array $params
     * @return integer
     */
    public function update(array $params): int;
}