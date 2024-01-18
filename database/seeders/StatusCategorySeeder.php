<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\StatusCategory;

class StatusCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void {
    $data = [
      [
        'id' => env('DB_STATUS_CATEGORY_POST', ''),
        'name' => 'Post',
      ],
      [
        'id' => env('DB_STATUS_CATEGORY_PENDING', ''),
        'name' => 'Pending',
      ],
      [
        'id' => env('DB_STATUS_CATEGORY_FEEDBACK', ''),
        'name' => 'Feedback',
      ],
      [
        'id' => env('DB_STATUS_CATEGORY_CANCELLED', ''),
        'name' => 'Cancelled',
      ],
      [
        'id' => env('DB_STATUS_CATEGORY_DONE', ''),
        'name' => 'Done',
      ],
      [
        'id' => env('DB_STATUS_CATEGORY_CLAIMED', ''),
        'name' => 'Claimed',
      ],
    ];

    foreach($data as $row) {
      StatusCategory::create($row);
    }
  }
}
