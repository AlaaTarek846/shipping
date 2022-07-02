<?php

namespace Database\Seeders;
use App\Models\ShipmentType;
use Illuminate\Database\Seeder;

class ShipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShipmentType::create([
            'type' => 'سكوتر',
            'price' => '40',
        ]);

        ShipmentType::create([
            'type' => 'عربية',
            'price' => '50',
        ]);
    }
}
