<?php

use Illuminate\Database\Seeder;
use App\Models\GiftCategory;
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
                'name' => 'はらぺこあおむし1',
                'point' => 2000,
                'image' => 'harapeko1.jpg',
            ],
            [
                'gift_category_id' => 1,
                'name' => 'はらぺこあおむし2',
                'point' => 2500,
                'image' => 'harapeko2.jpg',
            ],
            [
                'gift_category_id' => 1,
                'name' => 'はらぺこあおむし3',
                'point' => 1700,
                'image' => 'harapeko3.jpg',
            ],
            [
                'gift_category_id' => 1,
                'name' => 'はらぺこあおむし4',
                'point' => 1300,
                'image' => 'harapeko4.jpg',
            ],
        ];

        foreach ($data as $item) {
            GiftItem::create($item);
        }

        $giftCategories = GiftCategory::get();
        foreach ($giftCategories as $key => $value) {
            for ($i=1; $i<=10; $i++) {
                $data = [
                    'gift_category_id' => $value->id,
                    'name' => $value->title2 .$i,
                    'point' => 500 * $i,
                    'image' => 'noimage.jpg',
                ];
                GiftItem::create($data);
            }
        }
    }
}
