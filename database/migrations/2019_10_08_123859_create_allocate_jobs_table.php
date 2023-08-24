<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocate_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('complaint_id');
            $table->unsignedBigInteger('sse_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('resource_id');
            $table->integer('estimated_days');
            $table->timestamps();

            $table->foreign('complaint_id')->references('id')->on('complaints');
            $table->foreign('sse_id')->references('id')->on('users');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('resource_id')->references('id')->on('resources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allocate_jobs');
    }
}
