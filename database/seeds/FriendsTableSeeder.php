<?php

use Illuminate\Database\Seeder;

use App\Models\Friend;

class FriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 21; $i++) {
            $data = [
                'user_id' => 1,
                'friend_id' => $i,
            ];
            Friend::create($data);

            $data = [
                'user_id' => $i,
                'friend_id' => 1,
            ];
            Friend::create($data);
        }
    }
}
