<?php

namespace Database\Factories;
use App\Models\Area;
use App\Models\Citie;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Branch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $area = Area::pluck('id')->toArray();

        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'area_id' => $this->faker->randomElement($area),
        ];
    }
}
