<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouses = [
            array(1,1000,0,0,1000,0,0,1000),
            array(2,1500,0,0,1500,0,0,1500),
            array(3,1800,0,0,1800,0,0,1800),
            array(4,2000,0,0,2000,0,0,2000),
            array(5,2300,0,0,2300,0,0,2300),
            array(6,2500,0,0,2500,0,0,2500),
            array(7,2800,0,0,2800,0,0,2800),
            array(8,3000,0,0,3000,0,0,3000),
            array(9,3300,0,0,3300,0,0,3300),
            array(10,3500,0,0,3500,0,0,3500),
            array(11,3800,0,0,3800,0,0,3800),
            array(12,4000,0,0,4000,0,0,4000),
            array(13,4300,0,0,4300,0,0,4300),
            array(14,4500,0,0,4500,0,0,4500),
            array(15,2100,0,0,2100,0,0,2100),
            array(16,3100,0,0,3100,0,0,3100),
            array(17,3900,0,0,3900,0,0,3900),
            array(18,4400,0,0,4400,0,0,4400),
            array(19,5200,0,0,5200,0,0,5200),
            array(20,5500,0,0,5500,0,0,5500)
        ];
        foreach($warehouses as $warehouse){
            DB::table('warehouses')->insert([
                'product_id'=> $warehouse[0],
                'opening_balance'=>$warehouse[1],
                'sales_issue'=>$warehouse[2],
                'received'=>$warehouse[3],
                'availability'=>$warehouse[4],
                'sales_return'=>$warehouse[5],
                'damage'=>$warehouse[6],
                'closing_balance'=>$warehouse[7],
                'created_at' => now()
            ]);
        }
    }
}
