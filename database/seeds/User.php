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
            'phone_number' => '09088492991',
            'email' => 'Admin@amin.com',
            'role' => '4',
            'password' => '$2y$10$uWS4NxOSUhKImSbUM4MaYu.utd0tCiunUPYO3.Uybg72lgu4MwCFq',
           
        ]);
    }
}
