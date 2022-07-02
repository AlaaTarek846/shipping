<?php

namespace Database\Seeders;

use App\Models\TransportType;
use Illuminate\Database\Seeder;

class TransportTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransportType::create([
            'type' => 'سكوتر',
            'price' => '40',
        ]);

        TransportType::create([
            'type' => 'عربية',
            'price' => '50',
        ]);
    }
}
