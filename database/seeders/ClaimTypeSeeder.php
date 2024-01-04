<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ClaimType;
class ClaimTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      ClaimType::create([
        'id' => 1,
        'name' => 'Claim to ORHM'
      ]);
      ClaimType::create([
        'id' => 2,
        'name' => 'Claim by Soft-copy'
      ]);
      ClaimType::create([
        'id' => 3,
        'name' => 'Claim by Plastic ID'
      ]);
    }
}
