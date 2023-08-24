<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscalationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->string('complaint_status');
            $table->tinyInteger('l1_escalation_days');
            $table->string('l1_escalation_role');
            $table->tinyInteger('l2_escalation_days');
            $table->string('l2_escalation_role');
            $table->tinyInteger('l3_escalation_days');
            $table->string('l3_escalation_role');
            $table->timestamps();
            
            $table->foreign('department_id')->references('id')->on('super_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escalations');
    }
}
