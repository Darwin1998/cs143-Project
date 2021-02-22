<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'=>'Jon Snow',
            'address'=>'winterfell',
            'contact_number'=>'09123456789'

        ];
        DB::table('customers')->insert($data);
    }
}
