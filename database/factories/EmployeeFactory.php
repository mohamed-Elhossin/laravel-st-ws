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
            'join_date' => "2020-11-10",
            'end_date' => "2025-10-15",
            'user_id' => 1,
            'birth_date' => $this->faker->date('Y-m-d', '-20 years'),
            'type' => 'admin',
            'department_id' => 1,
        ];
    }
}
