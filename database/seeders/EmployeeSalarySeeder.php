<?php

namespace Database\Seeders;

use App\Models\EmployeeSalary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class EmployeeSalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeSalary::factory()->count(26)->create();
    }
}
