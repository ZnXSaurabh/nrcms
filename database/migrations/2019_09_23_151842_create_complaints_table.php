<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateComplaintsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('complaints', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');

            $table->string('comp_type');

            $table->string('comp_id');

            $table->unsignedBigInteger('division_id');

            $table->unsignedBigInteger('location_id');

            $table->unsignedBigInteger('area_id')->nullable();

            $table->unsignedBigInteger('service_building_id')->nullable();

            $table->unsignedBigInteger('sup_cat_id');

            $table->unsignedBigInteger('category_id');

            $table->unsignedBigInteger('sub_category_id');

            $table->text('description');

            $table->text('images')->nullable();

            $table->unsignedBigInteger('job_allocation_id')->nullable();

            $table->text('resolution')->nullable();

            $table->text('resolution_images')->nullable();

            $table->timestamp('resolution_date')->nullable();

            $table->text('feedback')->nullable();

            $table->string('satisfaction_level')->nullable();

            $table->string('status')->default('Initiated');

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

        Schema::dropIfExists('complaints');

    }

}

