<?php

namespace Database\Factories;

use App\Models\CompanyShippingAreaPrice;
use App\Models\Area;
use App\Models\Company;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyShippingAreaPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyShippingAreaPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $area = Area::pluck('id')->toArray();
        $company = Company::pluck('id')->toArray();

        return [
            'transportation_price' => 10,
            'delivery_time' => 80,
            'returned_time' => 78,
            'area_id' => $this->faker->randomElement($area),
            'company_id' => $this->faker->randomElement($company),

        ];

    }
}
