<?php

namespace App\Repositories\GivePoint;

use App\Models\GivePoint;

class GivePointRepository implements GivePointRepositoryInterface
{
    /**
     * GivePointRepository function
     *
     * @param GivePoint $model
     */
    public function __construct(
        GivePoint $model
    ) {
        $this->model = $model;
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