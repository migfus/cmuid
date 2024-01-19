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
        'name' => 'Claim to ORHM',
        'description' => 'You would required to claim from OHRM. The CSC-ID will be printed on paper.',
        'features' => json_encode([
          'Required Lamination',
        ]),
        'icon' => 'InboxArrowDownIcon',
      ]);
      ClaimType::create([
        'id' => env('DB_CLAIM_TYPE_SOFT', 'shit'),
        'name' => 'Soft-copy',
        'description' => 'You will be responsible for printing. We recommend for Plastic ID. \n \n',
        'features' => json_encode([
          'Do it yourself (DIY)',
        ]),
        'icon' => 'LinkIcon'
      ]);
      ClaimType::create([
        'id' => env('DB_CLAIM_TYPE_PLASTIC', 'shit'),
        'name' => 'Plastic ID',
        'description' => 'It can cost below 100 pesos, and it takes 1 day to process (via 3rd party printer).',
        'features' => json_encode([
          'It will cost more',
        ]),
        'icon' => 'IdentificationIcon'
      ]);
    }
}
