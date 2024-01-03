<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\Models\Device;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Device::create([
        'id' => 1234,
        'name' => 'MIUI SOmething',
        'platform' => 'Android',
        'last_response' => Carbon::now(),
      ]);


    }
}
