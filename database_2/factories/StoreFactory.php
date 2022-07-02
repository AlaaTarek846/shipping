<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Store;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $branch = Branch::pluck('id')->toArray();
        $employee = Employee::pluck('id')->toArray();

        return [
            'name' => $this->faker->name,
            'branche_id' => $this->faker->randomElement($branch),
            'employee_id' => $this->faker->randomElement($employee),
        ];
    }
}
