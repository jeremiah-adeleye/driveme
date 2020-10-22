<?php

use Illuminate\Database\Seeder;

class CoursePlan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('driving_plans')->insert([
            [
                'title' => "Starter",
                'description' => 'Four weeks of driving Lesson (Beginner) 1 Hour per class ',
                'total_lessons' => '26',
                'amount' => '45000',
                'bg_color' => '#021827'
            ],


            [
                'title' => "Weekend (Saturdays only)",
                'description' => '2 Hour per class for 7 weeks. This class is specifically for busy executives and other career professionals who do not have the luxury of time for our weekly classes ',
                'total_lessons' => '7',
                'amount' => '40000',
                'bg_color' => '#F9AA29'
            ],
            [
                'title' => "Pay As You Drive (PAYD)",
                'description' => '30 Minutes per class @ N2,000 per class, a minimum of 5 classes',
                'total_lessons' => '26',
                'amount' => '2000',
                'bg_color' => '#2BAB7B'
            ],
            [
                'title' => "Refresher",
                'description' => '1 Hour per class. This is a refresher class for learner drivers who already have some knowledge of driving. ',
                'total_lessons' => '10',
                'amount' => '20000',
                'bg_color' => '#74D19B',
            ]
        ]);
    }
}
