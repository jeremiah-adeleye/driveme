<?php

use Illuminate\Database\Seeder;

class Quiz extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->insert([
            [
                'course_id' => "1",
                
                'question' => 'what is the name of US president?',
                'option_a' => 'me',
                'option_b' => 'you',
                'option_c' => 'we',
                'option_d' => 'No one',
                'correct_option' => 'option_d'
            ],

            [
                'course_id' => "1",
                                'question' => 'Who owns Nigeria?',
                'option_a' => 'Jerry',
                'option_b' => 'Tom',
                'option_c' => 'Everyone',
                'option_d' => 'No one',
                'correct_option' => 'option_d'
            ],
            [
                'course_id' => "1",
                                'question' => 'When is the independence day?',
                'option_a' => '1990',
                'option_b' => '1992',
                'option_c' => '20009',              'option_d' => 'October 1',               'correct_option' => 'option_d'
            ],
            [
                'course_id' => "1",
                                'question' => 'What is ten?',
                'option_a' => '1010',
                'option_b' => 'tens',
                'option_c' => 'then',              'option_d' => '10',               'correct_option' => 'option_d'
            ],

        ]);
    }
}
