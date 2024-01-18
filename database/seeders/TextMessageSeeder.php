<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TextMessage;

class TextMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $data = [
        // [
        //   'device_id' => '1234',
        //   'user_register_id' => '12345',
        //   'content' => '1st Testing',
        // ],
        // [
        //   'device_id' => '1234',
        //   'user_register_id' => '12345',
        //   'content' => '2nd Testing',
        // ],
        // [
        //   'device_id' => '1234',
        //   'user_register_id' => '12345',
        //   'content' => '3rd Testing',
        // ],
        // [
        //   'device_id' => '1234',
        //   'user_register_id' => '12345',
        //   'content' => '4th Testing',
        // ],
        // [
        //   'device_id' => '1234',
        //   'user_register_id' => '12345',
        //   'content' => '5th Testing',
        // ],
      ];

      foreach($data as $row) {
        TextMessage::create($row);
      }
    }
}
