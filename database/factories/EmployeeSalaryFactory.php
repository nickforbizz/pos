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
class EmployeeSalaryFactory extends Factory
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
            'amount' => $this->faker->numberBetween(5000, 100000),
            'pay_frequency' => $this->faker->randomElement(['monthly','weekly','bi-weekly']),
            'pay_date' => $this->faker->date(),
            'fk_tenant' => $this->faker->randomElement($tenants),
            'fk_employee' => $this->faker->randomElement($employees),
        ];
    }
}
