<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$department = array('ADMIN','LOGISTIC','FACTORY','SALE','WAREHOUSE');
         $department = [
            array("ADMIN", "admin@email.com",1,1, "123456789"),
            array("LOGISTIC", "logistic@email.com",1,2, "123456789"),
            array("FACTORY", "factory@email.com",1,3,"123456789"),
            array("SALE", "sale@email.com",1,4,"123456789"),
            array("WAREHOUSE", "warehouse@email.com",1,5,"123456789"),

            ];

        foreach($department as $d){
            DB::table('users')->insert([
                'name' => $d[0],
                'email' => $d[1],
                'isAdmin' => $d[2],
                "department_id" => $d[3],
                "password" => password_hash($d[4], PASSWORD_BCRYPT),
                "created_at" => now(),
                "updated_at" => now()
            ]);
    }

}
}
