<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShipmentStatu;
class ShipmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShipmentStatu::create([
            'name' => 'طلب بيك اب',
        ]);

        ShipmentStatu::create([
            'name' => 'المندوب فى الطريق لاستلام البيك اب',
        ]);

        ShipmentStatu::create([
            'name' => 'تم استلام البيك اب',
        ]);

        ShipmentStatu::create([
            'name' => 'في الطريق الي المخزن',
        ]);

        ShipmentStatu::create([
            'name' => 'تم التسليم في المخزن',
        ]);

        ShipmentStatu::create([
            'name' => 'قيد التوصيل',
        ]);

        ShipmentStatu::create([
            'name' => 'تسليم ناجح',
        ]);

        ShipmentStatu::create([
            'name' => 'مرتجع جزئي  مسدد قيمة الشحن',
        ]);

        ShipmentStatu::create([
            'name' => ' مرتجع جزئي و لم يسديد قيمة الشحن',
        ]);

        ShipmentStatu::create([
            'name' => 'مرتجع كامل مسدد قيمة الشحن',
        ]);

        ShipmentStatu::create([
            'name' => 'مرتجع كامل و لم يسدد قيمة الشحن',
        ]);

        ShipmentStatu::create([
            'name' => 'شحنه ملغية',
        ]);

    }
}
