<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('fathername')->nullable();
            $table->string('pfno')->unique()->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('location_id')->nullable();
            $table->string('area_id')->nullable();
            $table->string('housetype_id')->nullable();
            $table->string('block_id')->nullable();
            $table->string('qtrno')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
