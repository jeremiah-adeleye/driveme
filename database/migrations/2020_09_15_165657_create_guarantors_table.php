<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuarantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guarantors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('relationship');
            $table->string('occupation');
            $table->string('residential_address');
            $table->string('state_of_residence');
            $table->string('work_address');
            $table->string('passport')->nullable();
            $table->unsignedBigInteger('driver_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guarantors');
    }
}
