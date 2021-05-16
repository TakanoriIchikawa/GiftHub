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
                'name' => '市川未央',
                'login_id' => 'miomio',
                'email' => 'mio1018@icloud.com',
                'password' => bcrypt('mio1018'),
            ],
            [
                'name' => '市川貴教',
                'login_id' => 'takanori',
                'email' => 'axela0104@icloud.com',
                'password' => bcrypt('takanori0315'),
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}
