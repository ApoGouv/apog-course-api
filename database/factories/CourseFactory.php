<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\course>
 */
class CourseFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraphs(
                fake()->numberBetween(3, 6),
                true
            ),
            'status' => fake()->randomElement(['Published' ,'Pending']),
            'is_premium' => fake()->numberBetween(0, 1),
            'created_at' => fake()->dateTimeBetween('-2 weeks', 'now'),
        ];
    }
}
