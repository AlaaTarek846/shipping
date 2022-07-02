<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email'=>'company@company.com',
            'phone_number'=>'01208834099',
            'user_type'=>'company',
            'password'=> bcrypt('123456789'),

        ]);
        $company = Company::create([
            'name' => 'Super_company',
            'phone' => '12345678916',
            'user_id' => $user->id,
            'branch_id' => 1,
            'city_id' => 1,
        ]);
    }
}
