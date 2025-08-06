<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\EmployeeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            $this->call(CountrySeeder::class);

        User::factory(1)->create();
        $this->call(DepartmentSeeder::class);

        $this->call(EmployeeSeeder::class);
    }
}
