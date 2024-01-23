<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suppliers>
 */
class SuppliersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company,
        'address' => fake()->streetAddress,
        'city' => fake()->city,
        'pin' => fake()->postcode,
        'district' => fake()->state,
        'contact_name' => fake()->name,
        'email' => fake()->unique()->safeEmail,
        'phone' => fake()->phoneNumber,
        ];
    }
}
