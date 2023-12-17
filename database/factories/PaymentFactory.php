<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arUserLogins = \App\Models\User::pluck('login')->toArray();

        return [
            'outer_payment_id' => rand(10, 100),
            'type' => $this->faker->randomElement(['deposit', 'withdrawal']),
            'user_login' => $this->faker->randomElement($arUserLogins),
            'requisites' => $this->faker->sentence(rand(10, 50)),
            'sum' => rand(1000, 10000),
            'currency' => $this->faker->randomElement(['RUB', 'USD']),
            'status' => rand(0, 1),
        ];
    }
}
