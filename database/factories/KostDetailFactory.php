<?php

namespace Database\Factories;

use App\Models\KostDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class KostDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KostDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kost_id' => $this->faker->randomDigitNotNull,
        'name' => $this->faker->word,
        'room_type' => $this->faker->word,
        'description' => $this->faker->text,
        'room_spec' => $this->faker->text,
        'room_facility' => $this->faker->text,
        'bathroom_facility' => $this->faker->text,
        'others_facility' => $this->faker->text,
        'rules' => $this->faker->text,
        'price' => $this->faker->randomDigitNotNull,
        'promo_price' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
