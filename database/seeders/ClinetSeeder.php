<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClinetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $user = User::create([
                'email'=>'client@client.com',
                'phone_number'=>'12345678911',
                'user_type'=>'client',
                'password'=> bcrypt('123456789'),

            ]);
            $client = Client::create([
                'name' => 'Super_client',
                'phone' => '12345678912',
                'user_id' => $user->id,
                'city_id' => 1,
            ]);
    }
}
