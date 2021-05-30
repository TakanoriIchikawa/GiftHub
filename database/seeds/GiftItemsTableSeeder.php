<?php

use Illuminate\Database\Seeder;
use App\Models\GiftItem;

class GiftItemsTableSeeder extends Seeder
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
                'gift_category_id' => 1,
                'name' => '赤ちゃんのおもちゃA',
                'point' => 1500,
            ],
            [
                'gift_category_id' => 1,
                'name' => '赤ちゃんのおもちゃB',
                'point' => 1000,
            ],
            [
                'gift_category_id' => 1,
                'name' => '赤ちゃんのおもちゃC',
                'point' => 700,
            ],
            [
                'gift_category_id' => 2,
                'name' => 'お子様のおもちゃA',
                'point' => 3000,
            ],
            [
                'gift_category_id' => 2,
                'name' => 'お子様のおもちゃB',
                'point' => 2000,
            ], 
            [
                'gift_category_id' => 2,
                'name' => 'お子様のおもちゃC',
                'point' => 1000,
            ],
            [
                'gift_category_id' => 3,
                'name' => 'お菓子A',
                'point' => 1200,
            ],
            [
                'gift_category_id' => 3,
                'name' => 'お菓子B',
                'point' => 600,
            ], 
            [
                'gift_category_id' => 3,
                'name' => 'お菓子C',
                'point' => 300,
            ],
        ];

        foreach ($data as $item) {
            GiftItem::create($item);
        }
    }
}
