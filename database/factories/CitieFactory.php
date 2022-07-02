<?php

namespace Database\Factories;
use App\Models\Governorate;
use App\Models\Citie;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Citie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $Governorate = Governorate::pluck('id')->toArray();

        return [
            'city_name_ar' => $this->faker->name,
            'governorate_id' => $this->faker->randomElement($Governorate),

        ];
    }
}
