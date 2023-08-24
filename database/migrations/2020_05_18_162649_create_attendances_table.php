<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->integer('shift_id')->unsigned();
            $table->integer('resources_id')->unsigned();
            $table->date('att_date')->nullable();
            $table->time('timeIn')->nullable();
            $table->time('timeOut')->nullable();
            $table->string('status')->default('Present');
            $table->timestamps();

            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('area_id')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}