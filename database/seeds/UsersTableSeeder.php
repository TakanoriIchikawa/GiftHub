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
        User::create([
            'name' => '市川千耀',
            'login_id' => 'chiaki',
            'email' => 'chiaki0223@icloud.com',
            'password' => bcrypt('chiaki0223'),
        ]);
    }
}
