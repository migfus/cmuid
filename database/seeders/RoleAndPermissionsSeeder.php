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

    // NOTE USERS
    // Permission::create(['name' => 'index user']);
    // Permission::create(['name' => 'store user']);
    // Permission::create(['name' => 'update user']);
    // Permission::create(['name' => 'destroy user']);

    // NOTE PROFILE
    Permission::create(['name' => 'index profile']);
    Permission::create(['name' => 'update profile']);

    $role = Role::create(['name' => 'Admin']);
    $role->givePermissionTo([
      // 'index user',     'store user',     'update user',
      // 'index post',     'store post',     'update post',
      // 'index faq',      'store faq',      'update faq',
      // 'index event',    'store event',    'update event',
      // 'index person',   'store person',   'update person',
      // 'index dashboard','store dashboard','update dashboard','destroy dashboard',
      'index profile', 'update profile'
    ]);
  }
}
