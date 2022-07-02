<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PackageSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FactorySeeder::class);
        $this->call(ShipmentStatusSeeder::class);
        $this->call(ServiceTypesSeeder::class);
        $this->call(PaymentTypeSeeder::class);
//        $this->call(RepresentativeSeeder::class);
//        $this->call(ClinetSeeder::class);
//        $this->call(CompanySeeder::class);
        $this->call(TransportTypesSeeder::class);
//        $this->call(EmployeeSeeder::class);
        $this->call(ReasonSeeder::class);
    }
}
