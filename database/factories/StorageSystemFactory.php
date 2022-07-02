<?php

namespace Database\Factories;

use App\Models\StorageSystem;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorageSystemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StorageSystem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->title,
        ];


    }
}
