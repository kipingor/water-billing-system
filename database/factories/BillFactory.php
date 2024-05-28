<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
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
            'billing_period' => $this->faker->monthName($this->faker->numberBetween(1, 12)) . ' ' . $this->faker->year(),
            'due_date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 300, 10000),
            'status' => $this->faker->randomElement(['due', 'paid', 'partially paid', 'overdue']),
        ];
    }

    /**
     * Indicate that the customer is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_status' => 'pending',
            ];
        });
    }

    /**
     * Indicate that the customer is inactive.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function paid()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_status' => 'paid',
            ];
        });
    }

    /**
     * Indicate that the customer is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function overdue()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_status' => 'overdue',
            ];
        });
    }
}
