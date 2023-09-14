<?php

namespace Database\Seeders;

use App\Enums\DepartmentEnum;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedData = [];
        for($i = 0;$i<10000;$i++)
        {
            $seedData[] = [
                'first_name' => fake()->firstName(),
                'last_name'  => fake()->lastName(),
                'email'      => fake()->randomLetter() . fake()->unique()->safeEmail(),
                'phone'      => fake()->phoneNumber(),
                'department' => $this->getRandomDepartment(),
                'hire_date' => fake()->date,
                'user_id' => fake()->numberBetween(1, 11),
            ];
        }

        $chunked = array_chunk($seedData, 2000);
        foreach ($chunked as $chunk) {
            Employee::insert($chunk);
        }

    }

    private function getRandomDepartment()
    {
        $departments = DepartmentEnum::all();
        return $departments[array_rand($departments)];
    }
}

