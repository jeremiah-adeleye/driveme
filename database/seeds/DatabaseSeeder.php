<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CoursePlan::class);
        $this->call(Quiz::class);
        $this->call(User::class);
        $this->call(vehicle::class);
    }
}
