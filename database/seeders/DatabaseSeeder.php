<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Customer;
use App\Models\Factory;
use App\Models\Logistic;
use App\Models\Receipe;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            ProductSeeder::class,
            IngredientSeeder::class,
            DriverSeeder::class,
            WarehouseSeeder::class,
            ReceipeSeeder::class,
            UserSeeder::class
        ]);
    }
}
