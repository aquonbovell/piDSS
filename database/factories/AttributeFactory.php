<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id' => $this->faker->numberBetween(1, 150),
            'name' => $this->faker->randomElement(['weight', 'capacity', 'voltage', 'size', 'wattage', 'efficiency', 'length']),
            'value' => $this->faker->numberBetween(20, 200),
            'unit' => $this->faker->randomElement(['g', 'kg', 'm', '%']),
            // Define other attributes as needed
        ];
    }
}
