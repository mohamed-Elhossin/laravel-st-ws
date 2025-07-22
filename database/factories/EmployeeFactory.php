<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'position' => "Front-End Team Leader",
            'salary' => "65000",
            'join_date' => "15/10/2024",
            'end_date' => "15/10/2025",
            'user_id' => \App\Models\User::inRandomOrder()->first()?->id ?? \App\Models\User::factory(),
            'birth_date' => $this->faker->date('Y-m-d', '-20 years'),
            'type' => 'admin',
            'department_id' => \App\Models\Department::inRandomOrder()->first()?->id ?? \App\Models\Department::factory(),
        ];
    }
}
