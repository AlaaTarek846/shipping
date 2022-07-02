<?php

namespace Database\Seeders;

use App\Models\Reason;
use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reason::create([
            'name' => 'منتج غير ملائم',
        ]);

        Reason::create([
            'name' => 'جودة غير مقبولة',
        ]);


        Reason::create([
            'name' =>'عميل متهرب',
        ]);

        Reason::create([
            'name' => 'مشكلة تخص السعر',
        ]);

        Reason::create([
            'name' => 'تأخير التوصيل',
        ]);

        Reason::create([
            'name' => 'الطلب مكرر',
        ]);

        Reason::create([
            'name' => 'التغليف تالف',
        ]);

        Reason::create([
            'name' => 'التليفون مغلق',
        ]);

        Reason::create([
            'name' => 'العميل لا يرد',
        ]);

        Reason::create([

            'name' => 'عنوان خطأ',
        ]);

    }
}
