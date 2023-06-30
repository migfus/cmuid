<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
  public function run(): void {
    $snowflake = app('Kra8\Snowflake\Snowflake');
    $data = [
      [
        'id' => 562170295142717710,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'O+',
      ],
      [
        'id' => 562170295142717711,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'O-',
      ],
      [
        'id' => 562170295142717712,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'A+',
      ],
      [
        'id' => 562170295142717713,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'A-',
      ],
      [
        'id' => 562170295142717714,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'B+',
      ],
      [
        'id' => 562170295142717715,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'B-',
      ],
      [
        'id' => 562170295142717716,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'AB+',
      ],
      [
        'id' => 562170295142717717,
        'user_id' => $_ENV['SEEDER_USER_ID'], //admin [first user],
        'name'    => 'AB-',
      ],
    ];


    foreach($data as $row) {
      \App\Models\BloodType::create($row);
    }
  }
}
