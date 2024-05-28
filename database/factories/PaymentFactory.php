<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bill_id' => \App\Models\Bill::factory(), // Assuming Bill model exists and has a factory
            'payment_date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 0, 1000), // Random amount between 0 and 1000
            'payment_method' => $this->faker->randomElement(['mpesa', 'cash', 'bank_transfer', 'other']),
            'reference_number' => $this->faker->optional()->uuid,
        ];
    }
}
