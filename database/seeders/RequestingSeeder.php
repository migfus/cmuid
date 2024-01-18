<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Requesting;

class RequestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Requesting::create([
        'id' => 'skdfi',
        'claim_type_id' => env('DB_CLAIM_TYPE_OHRM', ''),
        'status_category_id' => env('DB_STATUS_CATEGORY_FEEDBACK', ''),
        'picture' => 'https://static.vecteezy.com/system/resources/previews/002/002/257/non_2x/beautiful-woman-avatar-character-icon-free-vector.jpg',
        'thumbnail' => 'https://static.vecteezy.com/system/resources/previews/002/002/257/non_2x/beautiful-woman-avatar-character-icon-free-vector.jpg',
        'last_name' => '[test]',
        'first_name' => '[test]',
        'position' => '[Postion]',
        'mobile' => 9978663855,
      ]);
    }
}
