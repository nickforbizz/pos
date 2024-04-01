<?php

namespace Database\Seeders;

use App\Models\EmployeeAttendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class EmployeeAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeAttendance::factory()->count(98)->create();
    }
}
