<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(TenantSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(EmployeeSalarySeeder::class);
        $this->call(EmployeeAttendanceSeeder::class);
        $this->call(OrderSeeder::class);
        
        $this->call(GuardSeeder::class);
        $this->call(PermissionTableSeeder::class);

        
    }
}
