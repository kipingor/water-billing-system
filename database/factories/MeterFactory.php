<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meter>
 */
class MeterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => \App\Models\Customer::factory(), // Assuming Customer model exists and has a factory
            'meter_number' => $this->faker->unique()->numerify('Meter###'),
            'location' => $this->faker->address,
            'meter_type' => $this->faker->randomElement(['analog', 'digital']),
            'meter_status' => $this->faker->randomElement(['active', 'inactive', 'replaced']),
            'installation_date' => $this->faker->date(),
        ];
    }

    /**
     * Indicate that the customer is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_status' => 'active',
            ];
        });
    }

    /**
     * Indicate that the customer is inactive.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_status' => 'inactive',
            ];
        });
    }

    /**
     * Indicate that the customer is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function replaced()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_status' => 'replaced',
            ];
        });
    }
}
