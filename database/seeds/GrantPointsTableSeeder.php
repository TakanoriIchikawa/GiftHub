<?php

use Illuminate\Database\Seeder;
use App\Models\GrantPoint;
use Carbon\Carbon;

class GrantPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $dt = new Carbon();
        $oneMonthLater = $dt->addMonth(1);
        $dt = new Carbon;
        $twoMonthLater = $dt->addMonth(2);

        $data = [
            [
                'user_id' => 1,
                'grant_point' => 500,
                'available_point' => 500,
                'expiration_date' => $yesterday,
            ],
            [
                'user_id' => 1,
                'grant_point' => 1000,
                'available_point' => 500,
                'expiration_date' => $today,
            ],
            [
                'user_id' => 1,
                'grant_point' => 2000,
                'available_point' => 2000,
                'expiration_date' => $tomorrow,
            ],
            [
                'user_id' => 1,
                'grant_point' => 4000,
                'available_point' => 4000,
                'expiration_date' => $oneMonthLater,
            ],
            [
                'user_id' => 1,
                'grant_point' => 5000,
                'available_point' => 5000,
                'expiration_date' => $twoMonthLater,
            ],
            [
                'user_id' => 2,
                'grant_point' => 5000,
                'available_point' => 5000,
                'expiration_date' => $twoMonthLater,
            ],
            [
                'user_id' => 3,
                'grant_point' => 1000,
                'available_point' => 1000,
                'expiration_date' => $twoMonthLater,
            ],
        ];

        foreach ($data as $grantPoint) {
            GrantPoint::create($grantPoint);
        }
    }
}
