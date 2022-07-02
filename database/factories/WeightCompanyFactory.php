<?php

namespace Database\Factories;

use App\Models\WeightCompany;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WeightCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company = Company::pluck('id')->toArray();

        return [
            'type' => $this->faker->name,
            'limit' => 5,
            'price' => 20,
            'company_id' => $this->faker->randomElement($company),
        ];
    }
}
