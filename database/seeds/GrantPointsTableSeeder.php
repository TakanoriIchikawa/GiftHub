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
        $dt = new Carbon;
        $twoMonthLater = $dt->addMonth(2);

        $data = [
            [
                'user_id' => 1,
                'grant_point' => 20000,
                'available_point' => 17000,
                'expiration_date' => $twoMonthLater,
            ],
            [
                'user_id' => 2,
                'grant_point' => 5000,
                'available_point' => 3000,
                'expiration_date' => $twoMonthLater,
            ],
            [
                'user_id' => 3,
                'grant_point' => 5000,
                'available_point' => 3000,
                'expiration_date' => $twoMonthLater,
            ],
        ];

        foreach ($data as $grantPoint) {
            GrantPoint::create($grantPoint);
        }
    }
}
