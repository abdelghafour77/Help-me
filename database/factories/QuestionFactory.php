<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'view_count' => rand(0, 1000),
            // 'answers_count' => rand(0, 10),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
