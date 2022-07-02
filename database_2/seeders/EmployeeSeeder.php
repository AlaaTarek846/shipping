<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email'=>'employee@employee.com',
            'phone_number'=>'01208834099',
            'user_type'=>'employee',
            'password'=> bcrypt('123456789'),

        ]);
        $employee = Employee::create([
            'name' => 'Super_employee',
            'address' => 'Super_employee',
            'salary' => 1020,
            'wallet' => 1720,
            'commission' => 1920,
            'user_id' => $user->id,
            'branch_id' => 1,
            'department_id' => 1,
            'job_id' => 1,
            'city_id' => 1,
        ]);
    }
}
