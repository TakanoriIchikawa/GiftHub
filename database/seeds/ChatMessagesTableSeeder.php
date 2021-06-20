<?php

use Illuminate\Database\Seeder;

use App\Models\ChatMessage;

class ChatMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 6; $i++) {
            $data = [
                'send_user_id' => 1,
                'receive_user_id' => $i,
                'message' => '千耀です！よろしく！！',
            ];
            ChatMessage::create($data);

            $data = [
                'send_user_id' => $i,
                'receive_user_id' => 1,
                'message' => 'はにゃ',
            ];
            ChatMessage::create($data);
        }

        $data = [
            'send_user_id' => 2,
            'receive_user_id' => 1,
            'message' => 'ジョナサンです！',
        ];
        ChatMessage::create($data);

        $data = [
            'send_user_id' => 1,
            'receive_user_id' => 2,
            'message' => 'ちわ',
        ];
        ChatMessage::create($data);

        $data = [
            'send_user_id' => 2,
            'receive_user_id' => 1,
            'message' => 'うぐ',
        ];
        ChatMessage::create($data);
    }
}
