<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'quantity' => $this->faker->numberBetween(1, 100),
            'category' => $this->faker->randomElement(['battery', 'solar panel', 'inverter', 'wire', 'cable', 'adapter']),
            'price' => $this->faker->randomFloat(2, 100, 10000),
            // Define other attributes as needed
        ];
    }
}
