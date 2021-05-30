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
                'login_id' => 'chiaki',
                'email' => 'chiaki0223@icloud.com',
                'password' => bcrypt('chiaki0223'),
            ],
            [
                'name' => 'ジョナ3',
                'login_id' => 'jona_3',
                'email' => 'axela0104@icloud.com',
                'password' => bcrypt('jona333'),
            ],
            [
                'name' => '温泉饅頭',
                'login_id' => 'onsen_2',
                'email' => 'axela0104@icloud.com',
                'password' => bcrypt('onsen222'),
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
        factory(User::class, 100)->create();
    }
}
