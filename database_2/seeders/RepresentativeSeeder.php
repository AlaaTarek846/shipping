<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Representative;
use App\Models\User;
class RepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email'=>'representative@representative.com',
            'phone_number'=>'12345678913',
            'user_type'=>'representative',
            'password'=> bcrypt('123456789'),

        ]);
        $representative = Representative::create([
            'name' => 'Super_representative',
            'address' => 'Super_representative',
            'wallet' => '1000',
            'salary' => '1000',
            'commission' => '200',
            'user_id' => $user->id,
            'city_id' => 1,

        ]);
    }
}
