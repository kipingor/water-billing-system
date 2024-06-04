<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MeterReading>
 */
class MeterReadingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'meter_id' => \App\Models\Meter::factory(),
            'reading_date' => $this->faker->date(),
            'reading_value' => $this->faker->randomFloat(2, 0, 200),
            'employee_id' => \App\Models\User::factory(),
            'reading_type' => $this->faker->randomElement(['manual', 'automatic']),
        ];
    }
}
