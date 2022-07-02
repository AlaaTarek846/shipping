<?php

namespace Database\Factories;

use App\Models\Complain;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complain::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::pluck('id')->toArray();

        return [
            'notes' => $this->faker->name,
            'user_id' => $this->faker->randomElement($user),
        ];
    }
}
