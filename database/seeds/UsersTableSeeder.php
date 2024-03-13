<?php

use App\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::where('name', '=', 'User')->first();
        $adminRole = Role::where('name', '=', 'Admin')->first();
        $permissions = Permission::all();

        /*
         * Add Users
         *
         */
        if (User::where('email', '=', 'admin@eximuz.com')->first() === null) {
            $newUser = User::create([
                'name'     => 'Admin',
                'email'    => 'admin@eximuz.com',
                'password' => bcrypt('100100'),
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (User::where('email', '=', 'user@eximuz.com')->first() === null) {
            $newUser = User::create([
                'name'     => 'User',
                'email'    => 'user@eximuz.com',
                'password' => bcrypt('100100'),
            ]);

            $newUser;
            $newUser->attachRole($userRole);
        }
    }
}
