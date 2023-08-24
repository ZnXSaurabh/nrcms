<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateServiceBuildingsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('service_buildings', function (Blueprint $table) {

            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('division_id');

            $table->unsignedBigInteger('location_id');

            $table->unsignedBigInteger('area_id');

            $table->string('name');

            $table->string('area_covered');

            $table->string('address');

            $table->string('contact_no');

            $table->string('email')->nullable();

            $table->string('status');

            $table->text('description')->nullable();

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

        Schema::dropIfExists('service_buildings');

    }

}

