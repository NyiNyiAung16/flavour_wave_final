<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            array('NyiNyiAung','nyinyi@gmail.com',true,1,'nyinyi123'),
            array('MgMg','mgmg@gmail.com',true,3,'mgmg123'),
            array('TunTun','tuntun@gmail.com',true,2,'tuntun123'),
            array('SuSu','susu@gmail.com',true,4,'susu123'),
            array('LinLin','linlin@gmail.com',true,5,'linlin123'),
            array('AungAung','aungaung@gmail.com',false,0,'aungaung123'),
        ];
        foreach($users as $user){
            DB::table('users')->insert([
                'name' => $user[0],
                'email' => $user[1],
                'isAdmin' => $user[2],
                'department_id' => $user[3],
                'password' => password_hash($user[4],PASSWORD_BCRYPT)
            ]);
        }
    }
}
