<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceType::create([
            'type' => 'تسليم و تحصيل',
        ]);

        ServiceType::create([
            'type' => ' تحصيل',
        ]);

        ServiceType::create([
            'type' => ' تسليم',
        ]);
    }
}
