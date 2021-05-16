<?php

use Illuminate\Database\Seeder;
use App\Models\PrizeCategory;

class PrizeCategoriesTableSeeder extends Seeder
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
                'name' => 'Baby',
                'path' => 'baby',
                'title1' => 'Prizes for Baby',
                'title2' => '赤ちゃん',
                'icon' => 'fas fa-baby',
                'image_name' => 'baby.jpg',
            ],
            [
                'name' => 'Kids',
                'path' => 'kids',
                'title1' => 'Prizes for Kids',
                'title2' => 'お子様',
                'icon' => 'fas fa-child',
                'image_name' => 'kids.jpg',
            ],
            [
                'name' => 'Sweets',
                'path' => 'sweets',
                'title1' => 'Sweets Prizes',
                'title2' => 'お菓子',
                'icon' => 'fas fa-cookie',
                'image_name' => 'sweets.jpg',
            ],
            [
                'name' => 'Mens',
                'path' => 'mens',
                'title1' => 'Mens Fashion Prizes',
                'title2' => 'メンズ',
                'icon' => 'fas fa-tshirt',
                'image_name' => 'mens.jpg',
            ],
            [
                'name' => 'Ladies',
                'path' => 'ladies',
                'title1' => 'Ladies Fashion Prizes',
                'title2' => 'レディース',
                'icon' => 'fas fa-tshirt',
                'image_name' => 'ladies.jpg',
            ],
            [
                'name' => 'Book',
                'path' => 'book',
                'title1' => 'Book Prizes',
                'title2' => '書籍',
                'icon' => 'fas fa-book',
                'image_name' => 'book.jpg',
            ],
            [
                'name' => 'Interior',
                'path' => 'interior',
                'title1' => 'Interior Prizes',
                'title2' => 'インテリア',
                'icon' => 'fas fa-chair',
                'image_name' => 'interior.jpg',
            ],
            [
                'name' => 'Game',
                'path' => 'game',
                'title1' => 'Game Prizes',
                'title2' => 'ゲーム',
                'icon' => 'fas fa-gamepad',
                'image_name' => 'game.jpg',
            ],
        ];

        foreach ($data as $category) {
            PrizeCategory::create($category);
        }
    }
}
