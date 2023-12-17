<?php

namespace Database\Factories;

use App\Models\User;
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
            'outer_id' => rand(10, 100),
            'type' => $this->faker->randomElement(['deposit', 'withdrawal']),
            'login' => $this->faker->randomElement($arUserLogins),
            'requisites' => $this->faker->sentence(rand(1, 4)),
            'sum' => rand(1000, 10000),
            'currency' => $this->faker->randomElement(['RUB', 'USD']),
            'status' => rand(0, 1),
        ];
    }
}
