<?php

namespace Database\Factories;

use App\Models\Shipment;
use App\Models\Client;
use App\Models\Area;
use App\Models\ServiceType;
use App\Models\Store;
use App\Models\ShipmentStatu;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $client = Client::pluck('id')->toArray();
        $area = Area::pluck('id')->toArray();
        $service_type = ServiceType::pluck('id')->toArray();
        $Shipment_Statu = ShipmentStatu::pluck('id')->toArray();
        $store = Store::pluck('id')->toArray();
        $representative = Representative::pluck('id')->toArray();

        $user = User::pluck('id')->toArray();

        return [
            'name_shipment' => $this->faker->name,
            'description' => $this->faker->text,
            'customer_code' => $this->faker->numberBetween(),
            'product_price' => 200,
            'order_number' => $this->faker->numberBetween(),
            'count' => $this->faker->numberBetween(),
            'shipping_price' => 200,
            'weight' => $this->faker->numberBetween(),
            'size' => $this->faker->streetName,
            'notes' => $this->faker->streetName,
            'delivery_date' => $this->faker->date(),
            'client_id' => $this->faker->randomElement($client),
            'area_id' => $this->faker->randomElement($area),
            'service_type_id' => $this->faker->randomElement($service_type),
            'store_id' => $this->faker->randomElement($store),
            'shipment_status_id' => $this->faker->randomElement($Shipment_Statu),
            'representative_id' => $this->faker->randomElement($representative),
            'sender_id' => $this->faker->randomElement($user),

        ];
    }
}
