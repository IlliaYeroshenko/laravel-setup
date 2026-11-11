<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'title' => fake()->sentence(4),

        'description' => fake()->paragraph(),

        'status' => fake()->randomElement([
            'new',
            'in_progress',
            'done',
        ]),

        'project_id' =>
            \App\Models\Project::factory(),

        'author_id' =>
            \App\Models\User::factory(),

        'assigned_to' =>
            \App\Models\User::factory(),

        'due_date' =>
            fake()->dateTimeBetween(
                'now',
                '+1 month'
            )->format('Y-m-d'),
    ];
}
}
