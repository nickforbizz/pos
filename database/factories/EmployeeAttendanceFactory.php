<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModels\Supplier>
 */
class EmployeeAttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $tenants = Tenant::where('active',1)->get();
        $employees = Employee::where('active',1)->get();

        return [
            'date' => $this->faker->date(),
            'clock_in' => $this->faker->dateTime(),
            'clock_out' => $this->faker->dateTime(),
            'fk_tenant' => $this->faker->randomElement($tenants),
            'fk_employee' => $this->faker->randomElement($employees),
        ];
    }
}
