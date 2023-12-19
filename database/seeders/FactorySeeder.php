<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            array(1,200,100),
            array(2,200,130),
            array(3,200,170),
            array(4,220,170),
            array(5,220,190),
            array(6,240,130),
            array(7,200,100),
            array(8,280,190),
            array(9,280,240),
            array(10,250,220),
            array(11,200,200),
            array(12,300,200),
            array(13,300,240),
            array(14,300,290),
            array(15,290,220),
            array(16,220,110),
            array(17,220,170),
            array(18,270,170),
            array(19,250,190),
            array(20,250,200),
        ];

        foreach($products as $product){
            DB::table('factories')->insert([
                'product_id' => $product[0],
                'expected'=>$product[1],
                'actual'=>$product[2],
            ]);
        }

    }
}
