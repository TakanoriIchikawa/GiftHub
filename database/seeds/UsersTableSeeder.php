<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagePath = Storage::disk('s3')->url('img/avatars/');
        $data= [
            [
                'name' => '市川千耀',
                'email' => 'chiaki0223@icloud.com',
                'password' => bcrypt('chiaki0223'),
            ],
            [
                'name' => 'ジョナサン',
                'email' => 'jonathan0223@icloud.com',
                'password' => bcrypt('jonathan0223'),
            ],
            [
                'name' => 'マイケル',
                'email' => 'michael0223@icloud.com',
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
            $image = $imagePath .$images[$key];
            $data = [
                'image' => $image,
                'birth_year' => mt_rand(1995, 2020),
                'birth_month' => mt_rand(1, 12),
                'birth_day' => mt_rand(1, 31),
            ];
            User::where('id', $user->id)->update($data);
        }
    }
}
