<?php

namespace Database\Seeders;

use App\Models\Admin;
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
            'user_type'=>'admin',
            'password'=> bcrypt('123456789'),

        ]);
        $admin = Admin::create([
            'name' => 'Super_Admin',
            'user_id' => $user->id,
        ]);

        $user->attachRole('super_admin');
    }
}
