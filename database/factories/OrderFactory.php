<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random user
        $user = User::inRandomOrder()->first();

        // Set payment method
        $paymentMethod = $this->faker->randomElement(['Cash on Delivery', 'KBZPay']);

        // Set KBZPay number conditionally
        $kbzpayNumber = $user->phone_number;
        if ($paymentMethod === 'KBZPay') {
            $kbzpayNumber = $this->faker->numerify('09#########');
        }

        return [
            'user_id' => $user->id,
            'total_amount' => 0, // This will be calculated after order items are created
            'payment_method' => $paymentMethod,
            'kbzpay_number' => $kbzpayNumber,
            'status' => $this->faker->randomElement(['pending', 'completed', 'shipped']),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
}
