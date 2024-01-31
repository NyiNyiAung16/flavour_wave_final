<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = array('ADMIN','LOGISTIC','FACTORY','SALE','WAREHOUSE');

        foreach($department as $d){
            DB::table('departments')->insert([
                'name' => $d,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
