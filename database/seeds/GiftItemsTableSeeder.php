<?php

use Illuminate\Database\Seeder;
use App\Models\GiftCategory;
use App\Models\GiftItem;
use Illuminate\Support\Facades\Storage;

class GiftItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagePath = Storage::disk('s3')->url('img/gifts/items/');
        $data = [
            [
                'gift_category_id' => 1,
                'name' => 'はらぺこあおむし1',
                'point' => 2000,
                'image' => $imagePath .'harapeko1.jpg',
            ],
            [
                'gift_category_id' => 1,
                'name' => 'はらぺこあおむし2',
                'point' => 2500,
                'image' => $imagePath .'harapeko2.jpg',
            ],
            [
                'gift_category_id' => 1,
                'name' => 'はらぺこあおむし3',
                'point' => 1700,
                'image' => $imagePath .'harapeko3.jpg',
            ],
            [
                'gift_category_id' => 1,
                'name' => 'はらぺこあおむし4',
                'point' => 1300,
                'image' => $imagePath .'harapeko4.jpg',
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
                    'image' => $imagePath .'noimage.jpg',
                ];
                GiftItem::create($data);
            }
        }
    }
}
