<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $receipes = [
            array(1,1,3000),
            array(2,1,1500),
            array(3,1,750),
            array(4,1,2250),
            array(1,2,3600),
            array(5,2,1200),
            array(6,2,800),
            array(7,2,400),
            array(8,3,7500),
            array(1,3,3750),
            array(9,3,1250),
            array(10,3,750),
            array(11,4,2160),
            array(12,4,1440),
            array(13,4,1080),
            array(14,4,720),
            array(1,5,3520),
            array(15,5,880),
            array(16,5,660),
            array(17,5,440),
            array(18,6,3600),
            array(19,6,1800),
            array(20,6,600),
            array(21,6,2400),
            array(22,7,7000),
            array(46,7,5600),
            array(39,7,2800),
            array(23,7,1400),
            array(24,8,2700),
            array(13,8,1800),
            array(45,8,1500),
            array(26,8,750),
            array(27,9,7000),
            array(28,9,4500),
            array(29,9,3000),
            array(44,9,500),
            array(30,10,6250),
            array(1,10,3750),
            array(31,10,1250),
            array(4,10,2500),
            array(46,11,5280),
            array(8,11,4320),
            array(29,11,2400),
            array(47,11,1200),
            array(32,12,1760),
            array(33,12,1320),
            array(34,12,2640),
            array(4,12,1540),
            array(35,13,2880),
            array(45,13,2400),
            array(39,13,960),
            array(51,13,360),
            array(36,14,2800),
            array(37,14,4200),
            array(4,14,3360),
            array(45,14,3640),
            array(2,15,2700),
            array(38,15,1800),
            array(44,15,750),
            array(39,15,750),
            array(40,16,5000),
            array(12,16,1600),
            array(41,16,3000),
            array(39,16,1400),
            array(42,17,4000),
            array(43,17,2400),
            array(44,17,1000),
            array(45,17,3600),
            array(46,18,4140),
            array(44,18,1260),
            array(47,18,2700),
            array(39,18,900),
            array(48,19,4400),
            array(49,19,3600),
            array(39,19,2000),
            array(45,19,600),
            array(50,20,2400),
            array(19,20,2160),
            array(44,20,720),
            array(39,20,720)
        ];

        foreach($receipes as $receipe){
            DB::table('receipes')->insert([
                'ingredient_id' => $receipe[0],
                'product_id' => $receipe[1],
                'amount_grams'=>$receipe[2]
            ]);
        }
    }
}

