<?php

namespace App\Repositories\GivePoint;

use Illuminate\Support\Facades\Auth;
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

    /**
     * getGivePoints function
     * 贈ったポイントの一覧を取得
     * @return object
     */
    public function getGivePoints(): object
    {
        $userId = Auth::id();
        return $this->model
                    ->where('give_user_id', $userId)
                    ->get();
    }

    /**
     * getReceivePoints function
     * 貰ったポイントの一覧を取得
     * @return object
     */
    public function getReceivePoints(): object
    {
        $userId = Auth::id();
        return $this->model
                    ->where('receive_user_id', $userId)
                    ->get();
    }

}