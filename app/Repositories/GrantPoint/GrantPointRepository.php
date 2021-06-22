<?php

namespace App\Repositories\GrantPoint;

use App\Models\GrantPoint;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GrantPointRepository implements GrantPointRepositoryInterface
{
    /**
     * GrantPointRepository __construct
     *
     * @param GrantPoint $model
     */
    public function __construct(
        GrantPoint $model
    ) {
        $this->model = $model;
    }

    /**
     * getAvailablePoints function
     * 利用可能なポイントを取得
     * @return object
     */
    public function getAvailablePoints(): object
    {
        $userId = Auth::id();
        $today = Carbon::today();
        return $this->model
                    ->where('user_id', $userId)
                    ->where('expiration_date', '>=', $today)
                    ->orderBy('expiration_date')
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

    /**
     * update function
     * 更新処理
     * @param array $params
     * @return integer
     */
    public function update(array $params): int
    {
        return $this->model
                    ->where('id', $params['id'])
                    ->update($params);
    }
}