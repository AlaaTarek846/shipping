<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Province;
use App\Models\ShippingAreaPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingAreaPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingAreaPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $area = Area::pluck('id')->toArray();

        return [
            'transportation_price' => 15,
            'delivery_time' => 50,
            'returned_time' => 90,
            'area_id' => $this->faker->randomElement($area),

        ];
    }
}
