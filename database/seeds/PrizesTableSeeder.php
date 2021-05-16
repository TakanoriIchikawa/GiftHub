<?php

use Illuminate\Database\Seeder;
use App\Models\Prize;

class PrizesTableSeeder extends Seeder
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
                'prize_category_id' => 1,
                'name' => '赤ちゃんのおもちゃA',
                'points' => 1500,
            ],
            [
                'prize_category_id' => 1,
                'name' => '赤ちゃんのおもちゃB',
                'points' => 1000,
            ],
            [
                'prize_category_id' => 1,
                'name' => '赤ちゃんのおもちゃC',
                'points' => 700,
            ],
            [
                'prize_category_id' => 2,
                'name' => 'お子様のおもちゃA',
                'points' => 3000,
            ],
            [
                'prize_category_id' => 2,
                'name' => 'お子様のおもちゃB',
                'points' => 2000,
            ], 
            [
                'prize_category_id' => 2,
                'name' => 'お子様のおもちゃC',
                'points' => 1000,
            ],
            [
                'prize_category_id' => 3,
                'name' => 'お菓子A',
                'points' => 1200,
            ],
            [
                'prize_category_id' => 3,
                'name' => 'お菓子B',
                'points' => 600,
            ], 
            [
                'prize_category_id' => 3,
                'name' => 'お菓子C',
                'points' => 300,
            ],
        ];

        foreach ($data as $prize) {
            Prize::create($prize);
        }
    }
}
