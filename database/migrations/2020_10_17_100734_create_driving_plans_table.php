<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrivingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driving_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('total_lessons');
            $table->string('amount');
            $table->string('bg_color');
            $table->string('lesson_period');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driving_plans');
    }
}
