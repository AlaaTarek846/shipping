<?php

namespace Database\Seeders;
use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create([
            'type' => 'كاش',
            'description' => 'كاش',
        ]);

        PaymentType::create([
            'type' => 'فيزا',
            'description' => 'فيزا',
        ]);

    }
}
