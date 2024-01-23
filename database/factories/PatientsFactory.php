<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Enum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patients>
 */
class PatientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'dob' => fake()->date(),
            'sex' => fake()->randomElement(['0', '1','2']), // Assuming 'sex' field can have predefined values
            'user_type' => fake()->randomElement(['0', '1', '2']), // Assuming 'user_type' field values
            'phone' => fake()->phoneNumber,
            'mrd_no' => fake()->randomNumber(6),
            'address' => fake()->address,

        ];
    }
}
