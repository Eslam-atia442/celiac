<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserContract;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \DB::table('users')->where('type', UserTypeEnum::admin->value)->delete();
        $permissions = Permission::where('guard_name', 'sanctum')->get();
        $role = Role::findOrCreate('admin', 'sanctum');
        $role->givePermissionTo($permissions);
        $user = User::where('email' , 'admin@celiac.com')->first();
        if (!$user){
            $user = User::create([
                'name' => 'admin',
                'email' => 'admin@celiac.com',
                'phone' => 12345678910,
                'password' => 'celiac@123',
                'type' => UserTypeEnum::admin->value
            ]);
        }
        $user->assignRole($role);
    }
}
