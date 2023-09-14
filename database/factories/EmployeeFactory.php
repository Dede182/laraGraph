<?php

namespace Database\Factories;

use App\Enums\DepartmentEnum;
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
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'email'      => $this->faker->word() . $this->faker->unique()->safeEmail(),
            'phone'      => $this->faker->phoneNumber(),
            'department' => $this->getRandomDepartment(),
            'hire_date' => $this->faker->date(),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }

    private function getRandomDepartment()
    {
        $departments = DepartmentEnum::all();
        return $departments[array_rand($departments)];
    }
}
