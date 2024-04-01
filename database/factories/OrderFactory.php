<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModels\Supplier>
 */
class OrderFactory extends Factory
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
        $customers = Customer::where('active',1)->get();

        return [
            'order_date' => $this->faker->date(),
            'total_amount' => $this->faker->numberBetween(10000, 40000),
            'fk_tenant' => $this->faker->randomElement($tenants),
            'fk_employee' => $this->faker->randomElement($employees),
            'fk_customer' => $this->faker->randomElement($customers),
        ];
    }
}
