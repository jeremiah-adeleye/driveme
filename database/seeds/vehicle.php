<?php

use Illuminate\Database\Seeder;

class vehicle extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            'owner_id' => 1,
            'condition' => 'New',
            'fabrication' => '2020',
            'type' => 'Automatic',
            'capacity' => '2',
            'make' => 'Nissan',
            'amount_day' => '900000000',
            'img_url' => 'www.google.com/jerrycaffe',
        ]);
    }
}
