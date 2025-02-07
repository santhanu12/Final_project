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
            'user_id'=>\App\Models\User::factory(),
            'manager_id'=>2,
            'admin_id'=>1,
            'name'=>fake()->name(),
            'task'=>fake()->sentence(),
            'priorty'=>'low',
            'start_date'=>fake()->date(),
            'end_date'=>fake()->date(),
            'status'=>'Completed',
            'description'=>fake()->paragraph(),
        ];
    }
}
