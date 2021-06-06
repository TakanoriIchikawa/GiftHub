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
}