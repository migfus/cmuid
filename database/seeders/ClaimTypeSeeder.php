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
        'id' => env('DB_CLAIM_TYPE_OHRM', 'shit'),
        'name' => 'Claim to ORHM'
      ]);
      ClaimType::create([
        'id' => env('DB_CLAIM_TYPE_SOFT', 'shit'),
        'name' => 'Claim by Soft-copy'
      ]);
      ClaimType::create([
        'id' => env('DB_CLAIM_TYPE_PLASTIC', 'shit'),
        'name' => 'Claim by Plastic ID'
      ]);
    }
}
