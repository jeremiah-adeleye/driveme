<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverHiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_hires', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('reference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_hires');
    }
}
