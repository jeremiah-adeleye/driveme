<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->date('dob');
            $table->string('state');
            $table->string('address');
            $table->string('licence_number');
            $table->integer('experience');
            $table->string('vehicle_type');
            $table->string('cv')->nullable();
            $table->string('passport')->nullable();
            $table->integer('approval_status')->default(1);
            $table->unsignedBigInteger('user_id');

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
        Schema::dropIfExists('drivers');
    }
}
