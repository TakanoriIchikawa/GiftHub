<?php

use Illuminate\Database\Seeder;
use App\Models\GivePoint;

class GivePointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'give_point' => 2000,
                'give_user_id' => 1,
                'receive_user_id' => 2,
                'signature' => true,
                'message' => 'ありがとう',
            ],
            [
                'give_point' => 1000,
                'give_user_id' => 1,
                'receive_user_id' => 3,
                'signature' => true,
                'message' => 'ありがとう',
            ],
            [
                'give_point' => 2000,
                'give_user_id' => 2,
                'receive_user_id' => 1,
                'signature' => true,
                'message' => 'ありがとう',
            ],
            [
                'give_point' => 2000,
                'give_user_id' => 3,
                'receive_user_id' => 1,
                'signature' => true,
                'message' => 'ありがとう',
            ],
        ];

        foreach ($data as $givePoint) {
            GivePoint::create($givePoint);
        }
    }
}
