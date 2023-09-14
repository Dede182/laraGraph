<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'MainUser',
            'email' => 'mainUser@app.com',
            'password' => Hash::make('asdffdsa'),
        ]);

        $this->call([
            EmployeeSeeder::class,
        ]);
    }
}
