<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['info', 'warning', 'error']),
            'method' => $this->faker->randomElement(['GET', 'POST', 'PUT', 'DELETE']),
            'message' => $this->faker->sentence,
            'ip' => $this->faker->ipv4,
            'user_id' =>    User::all()->random()->id,
            'user_role' => User::all()->random()->roles->first()->name,
            'url' => $this->faker->url,
        ];
    }
}
