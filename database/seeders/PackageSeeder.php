<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageDetail;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = Package::create([
            'name'=>'name_one',
            'name_ar'=>'name_one',
            'title'=>'title_one',
            'title_ar'=>'title_one',
            'duration'=>'months',
            'duration_ar'=>'شهر',
            'count_months'=>'12',
            'price'=>'50',
            'cheack'=>'1',

        ]);
//        $PackageDetail = PackageDetail::create([
//            'name'=>'Package_one',
//            'name_ar'=>'Package_one',
//            'cheack'=>'1',
//            'package_id' => $packages->id,
//        ]);

        $packages = Package::create([
            'name'=>'name_two',
            'name_ar'=>'name_two',
            'title'=>'title_two',
            'title_ar'=>'title_two',
            'duration'=>'months',
            'duration_ar'=>'شهر',
            'count_months'=>'24',
            'price'=>'100',
            'cheack'=>'0',

        ]);
//        $PackageDetail = PackageDetail::create([
//            'name'=>'Package_two',
//            'name_ar'=>'Package_two',
//            'cheack'=>'0',
//            'package_id' => $packages->id,
//        ]);


        $packages = Package::create([
            'name'=>'name_three',
            'name_ar'=>'name_three',
            'title'=>'title_three',
            'title_ar'=>'title_three',
            'duration'=>'months',
            'duration_ar'=>'شهر',
            'count_months'=>'36',
            'price'=>'150',
            'cheack'=>'1',

        ]);
//        $PackageDetail = PackageDetail::create([
//            'name'=>'Package_three',
//            'name_ar'=>'Package_three',
//            'cheack'=>'0',
//            'package_id' => $packages->id,
//        ]);


        $packages = Package::create([
            'name'=>'name_four',
            'name_ar'=>'name_four',
            'title'=>'title_four',
            'title_ar'=>'title_four',
            'duration'=>'months',
            'duration_ar'=>'شهر',
            'count_months'=>'48',
            'price'=>'200',
            'cheack'=>'0',

        ]);
//        $PackageDetail = PackageDetail::create([
//            'name'=>'Package_four',
//            'name_ar'=>'Package_four',
//            'cheack'=>'1',
//            'package_id' => $packages->id,
//        ]);
    }
}
