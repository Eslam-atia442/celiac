<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $defaultPermissions = Permission::defaultPermissions();
        //delete permissions not exist
        Permission::whereNotIn('name', collect($defaultPermissions)->pluck('name'))->delete();
        Schema::disableForeignKeyConstraints();

        foreach ($defaultPermissions as $perm) {
            Permission::firstOrCreate($perm);
        }

        //attach permissions to role
        $roles = Role::all();
        foreach ($roles as $role) {
            $permissions = Permission::pluck('name')->toArray();
            $role->syncPermissions($permissions);
        }
        Schema::enableForeignKeyConstraints();
    }
}
