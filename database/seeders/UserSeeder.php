<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email'=>'super_admin@app.com',
            'phone_number'=>'12345678910',
            'user_type'=>'speradmin',
            'password'=> bcrypt('123456789'),

        ]);

        $SuperAdmin = SuperAdmin::create([
            'name' => 'Super_Admin',
            'user_id' => $user->id,
        ]);

        $user->attachRole('super_admin');

        $user = User::create([
            'email'=>'admin@admin.com',
            'phone_number'=>'12345678910',
            'user_type'=>'admin',
            'package_date'=>'2022-3-2',
            'package_id'=>'1',
            'password'=> bcrypt('123456789'),

        ]);
        $admin = Admin::create([
            'name' => 'Admin',
            'user_id' => $user->id,

        ]);

        $user->attachRole('super_admin');
    }
}
