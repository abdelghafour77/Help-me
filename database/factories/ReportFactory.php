<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // contain reportable_type , reportable_id , user_id, report_type_id, description, is_resolved, resolved_by, resolution, resolved_at, reported_at ,question_id, created_at, updated_at
            // question , answer
            'reportable_type' => $this->faker->randomElement(['question', 'answer']),
            // between 1 and 100
            'reportable_id' => $this->faker->numberBetween(1, 50),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'report_type_id' => \App\Models\ReportType::inRandomOrder()->first()->id,
            'description' => $this->faker->text,
            'is_resolved' => $this->faker->boolean,
            'resolved_by' => \App\Models\User::inRandomOrder()->first()->id,
            'resolution' => $this->faker->text,
            'resolved_at' => $this->faker->dateTime(),
            'reported_at' => $this->faker->dateTime(),
            'question_id' => \App\Models\Question::inRandomOrder()->first()->id,
            // 'created_at' => $this->faker->dateTime(),
            // 'updated_at' => $this->faker->dateTime(),

        ];
    }
}
