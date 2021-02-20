<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = [
            'first_name'=>'admin',
            'last_name'=>'admin',
            'email'=>'admin@yahoo.com',
            'password'=>'password',
            'position'=>'admin'

        ];
        
        $data["password"] = bcrypt($data["password"]);
        
        
        DB::table('users')->insert($data);
    }
}
