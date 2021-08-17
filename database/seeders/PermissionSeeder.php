<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'=>'page-access'
        ]);
        Permission::create([
            'name'=>'page-create'
        ]);
        Permission::create([
            'name'=>'page-edit'
        ]);
        Permission::create([
            'name'=>'page-delete'
        ]);
        Permission::create([
            'name'=>'user-access'
        ]);
        Permission::create([
            'name'=>'user-create'
        ]);
        Permission::create([
            'name'=>'user-edit'
        ]);
        Permission::create([
            'name'=>'user-delete'
        ]);
    }
}
