<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Province;

use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $province = Province::pluck('id')->toArray();

        return [
            'name' => $this->faker->name,
            'province_id' => $this->faker->randomElement($province),
        ];
    }
}
