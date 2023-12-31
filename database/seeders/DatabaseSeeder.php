<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
      $this->call([
        ClaimTypeSeeder::class,
        RoleAndPermissionsSeeder::class,
        UserSeeder::class,
        StatusCategorySeeder::class,
        DeviceSeeder::class,
        UserRegisterSeeder::class,
        TextMessageSeeder::class,
        DepartmentSeeder::class,
        UnitSeeder::class,
      ]);
    }
}
