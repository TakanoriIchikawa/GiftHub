<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [
            [
                'name' => '市川千耀',
                'email' => 'chiaki0223@icloud.com',
                'image' => '3.jpg',
                'password' => bcrypt('chiaki0223'),
            ],
            [
                'name' => 'ジョナサン',
                'email' => 'jonathan0223@icloud.com',
                'image' => '1.jpg',
                'password' => bcrypt('jonathan0223'),
            ],
            [
                'name' => 'マイケル',
                'email' => 'michael0223@icloud.com',
                'image' => '2.jpg',
                'password' => bcrypt('michael0223'),
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
        factory(User::class, 100)->create();

        $images = [
            'sample1.jpg', 'sample2.jpg', 'sample3.jpg', 'sample4.jpg', 'sample5.jpg', 'sample6.jpg', 'sample7.jpg', 'sample8.jpg'
        ];

        $users = User::get();
        foreach ($users as $user) {
            $key = array_rand($images);
            $image = $images[$key];
            $data = [
                'image' => $image
            ];
            User::where('id', $user->id)->update($data);
        }
    }
}
