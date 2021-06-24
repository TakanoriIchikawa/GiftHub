<?php

use Illuminate\Database\Seeder;
use App\Models\GiftCategory;

class GiftCategoriesTableSeeder extends Seeder
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
                'title1' => 'Gifts for Baby',
                'title2' => '赤ちゃん',
                'icon' => 'fas fa-baby',
                'image' => 'baby.jpg',
            ],
            [
                'name' => 'Kids',
                'path' => 'kids',
                'title1' => 'Gifts for Kids',
                'title2' => 'お子様',
                'icon' => 'fas fa-child',
                'image' => 'kids.jpg',
            ],
            [
                'name' => 'Sweets',
                'path' => 'sweets',
                'title1' => 'Sweets Gifts',
                'title2' => 'お菓子',
                'icon' => 'fas fa-cookie',
                'image' => 'sweets.jpg',
            ],
            [
                'name' => 'Book',
                'path' => 'book',
                'title1' => 'Book Gifts',
                'title2' => '書籍',
                'icon' => 'fas fa-book',
                'image' => 'book.jpg',
            ],
            [
                'name' => 'Flower',
                'path' => 'flower',
                'title1' => 'Flower Gifts',
                'title2' => '花',
                'icon' => 'fas fa-leaf',
                'image' => 'flower.jpg',
            ],
            [
                'name' => 'Game',
                'path' => 'game',
                'title1' => 'Game Gifts',
                'title2' => 'ゲーム',
                'icon' => 'fas fa-gamepad',
                'image' => 'game.jpg',
            ],
            [
                'name' => 'Mens',
                'path' => 'mens',
                'title1' => 'Mens Fashion Gifts',
                'title2' => 'メンズ',
                'icon' => 'fas fa-tshirt',
                'image' => 'mens.jpg',
            ],
            [
                'name' => 'Ladies',
                'path' => 'ladies',
                'title1' => 'Ladies Fashion Gifts',
                'title2' => 'レディース',
                'icon' => 'fas fa-tshirt',
                'image' => 'ladies.jpg',
            ],
            [
                'name' => 'Interior',
                'path' => 'interior',
                'title1' => 'Interior Gifts',
                'title2' => 'インテリア',
                'icon' => 'fas fa-chair',
                'image' => 'interior.jpg',
            ],
        ];

        foreach ($data as $category) {
            GiftCategory::create($category);
        }
    }
}
