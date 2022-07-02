<?php

namespace Database\Seeders;

use App\Models\Shipment;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Province;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Job;
use App\Models\Store;
use App\Models\StorageSystem;
use App\Models\Offer;
use App\Models\Weight;
use App\Models\WeightCompany;
use App\Models\ShippingAreaPrice;
use App\Models\CompanyShippingAreaPrice;
use App\Models\AdditionalService;
use App\Models\Governorate;
use App\Models\Citie;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Governorate::factory()->count(50)->create();
        Citie::factory()->count(100)->create();
        Country::factory()->count(5)->create();
        Province::factory()->count(50)->create();
        Area::factory()->count(100)->create();
        Branch::factory()->count(50)->create();
        Department::factory()->count(50)->create();
        Job::factory()->count(30)->create();
        Store::factory()->count(30)->create();
        Offer::factory()->count(10)->create();
        StorageSystem::factory()->count(10)->create();
        Shipment::factory()->count(10)->create();
        Weight::factory()->count(1)->create();
        WeightCompany::factory()->count(1)->create();
        ShippingAreaPrice::factory()->count(50)->create();
        CompanyShippingAreaPrice::factory()->count(50)->create();
        AdditionalService::factory()->count(10)->create();
    }
}
