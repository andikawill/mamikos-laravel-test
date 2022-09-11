<?php

namespace Database\Factories;

use App\Models\KostPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class KostPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KostPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kost_availability_id' => $this->faker->randomDigitNotNull,
        'customer_id' => $this->faker->randomDigitNotNull,
        'type' => $this->faker->word,
        'invoice_date' => $this->faker->word,
        'invoice_number' => $this->faker->word,
        'paid_date' => $this->faker->word,
        'payment_method' => $this->faker->word,
        'total' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
