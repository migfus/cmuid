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
        'id' => 1,
        'name' => 'Post',
      ],
      [
        'id' => 2,
        'name' => 'Pending',
      ],
      [
        'id' => 3,
        'name' => 'Feedback',
      ],
      [
        'id' => 4,
        'name' => 'Cancelled',
      ],
      [
        'id' => 5,
        'name' => 'Done',
      ],
      [
        'id' => 6,
        'name' => 'Claimed',
      ],
    ];

    foreach($data as $row) {
      StatusCategory::create($row);
    }
  }
}
