<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
  public function run(): void {
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // NOTE DASHBOARD
    Permission::create(['name' => 'index dashboard']);

    // NOTE REGISTER
    Permission::create(['name' => 'index register']);
    Permission::create(['name' => 'feedback register']);

    // NOTE DEVICE
    Permission::create(['name' => 'index device']);
    Permission::create(['name' => 'store device']);

    // NOTE PROFILE
    Permission::create(['name' => 'index profile']);
    Permission::create(['name' => 'update profile']);

    $role = Role::create(['name' => 'Admin']);
    $role->givePermissionTo([
      'index device',   'store device',
      'index register', 'feedback register',
      'index dashboard',
      'index profile',  'update profile'
    ]);
  }
}
