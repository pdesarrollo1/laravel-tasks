<?php

namespace Database\Factories;

use App\Models\User;
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
        $userIds = [1,2,3,4,5,6,7,8,9];
        return [
            'title'=>$this->faker->sentence(),
            'description'=>$this->faker->paragraph(2),
            'is_important'=>$this->faker->boolean(),
            'user_id'=>$this->faker->randomElement($userIds),
        ];
    }
}
