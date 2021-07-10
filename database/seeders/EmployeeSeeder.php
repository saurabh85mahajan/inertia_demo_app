<?php

namespace Database\Seeders;

use App\Models\Employee;
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
        //
        Employee::factory()->count(5)->create(['department_id' => 1]);
        Employee::factory()->count(3)->create(['department_id' => 2]);
        Employee::factory()->count(2)->create(['department_id' => 3]);
    }
}
