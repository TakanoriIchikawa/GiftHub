<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GivePoint\GivePointRepositoryInterface;
use App\Repositories\GrantPoint\GrantPointRepositoryInterface;

class GivePointService
{
    public function __construct(
        GivePointRepositoryInterface $givePointRepository,
        GrantPointRepositoryInterface $grantPointRepository
    ) {
        $this->givePointRepository = $givePointRepository;
        $this->grantPointRepository = $grantPointRepository;
    }

    /**
     * givePoint function
     * 有効ポイントを贈るポイント分減らし、ポイントを贈る
     * @param array $params
     * @return boolean
     */
    public function givePoint(array $params): bool
    {
        $params['give_user_id'] = Auth::id();
        $point = $params['give_point'];
        $grantPoints = $this->grantPointRepository->getAvailablePoints();

        DB::beginTransaction();
        try {
            foreach ($grantPoints as $grantPoint) {
                $point = $grantPoint->available_point - $point;
                $updateData['id'] = $grantPoint->id;
                if ($point < 0) {
                    $updateData['available_point'] = 0;
                    $this->grantPointRepository->update($updateData);
                    $point = abs($point);
                } else {
                    $updateData['available_point'] = $point;
                    $this->grantPointRepository->update($updateData);
                    break;
                }
            }

            $this->givePointRepository->create($params);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }

        return true;
    }
    
    /**
     * validateParams function
     * パラメータの検証
     * @param array $params
     * @return boolean
     */
    public function validateParams(array $params): bool
    {
        $result = $this->validateAvailablePoint($params['give_point']);
        if (!$result) {
            return false;
        }

        $result = $this->validateMessage($params['message']);
        if (!$result) {
            return false;
        }

        return true;
    }

    /**
     * validateAvailablePoint function
     * 贈るポイントの検証
     * 1以上かつ有効ポイント以下
     * @param integer $givePoint
     * @return boolean
     */
    public function validateAvailablePoint(int $givePoint): bool
    {
        $availablePoint = $this->grantPointRepository->getAvailablePoints()->sum('available_point');
        if (1 > $givePoint || $availablePoint < $givePoint) {
            return false;
        }
        return true;
    }

    /**
     * validateMessage function
     * メッセージの検証
     * 文字数は30文字以下
     * @param string|null $message
     * @return boolean
     */
    public function validateMessage(?string $message): bool
    {
        if (!empty($message) && 30 < mb_strlen($message)) {
            return false;
        }
        return true;
    }
}