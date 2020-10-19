<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => "admin",
            'last_name' => 'admin',
            'phone_number' => '09088492993',
            'email' => 'admin@amin.com',
            'role' => '4',
            'password' => 'Admin123.',
           
        ]);
    }
}
