<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserRegister;

class UserRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      UserRegister::create([
        'id' => '12345',
        'claim_type_id' => 1,
        'status_category_id' => 3,
        'picture' => 'https://static.vecteezy.com/system/resources/previews/002/002/257/non_2x/beautiful-woman-avatar-character-icon-free-vector.jpg',
        'thumbnail' => 'https://static.vecteezy.com/system/resources/previews/002/002/257/non_2x/beautiful-woman-avatar-character-icon-free-vector.jpg',
        'last_name' => '[test]',
        'first_name' => '[test]',
        'position' => '[Postion]',
        'mobile' => 9978663855,
      ]);
    }
}
