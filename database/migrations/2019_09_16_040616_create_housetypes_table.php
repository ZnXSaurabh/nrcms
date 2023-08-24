<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateHousetypesTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('housetypes', function (Blueprint $table) {

            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('division_id');

            $table->unsignedBigInteger('location_id');

            $table->unsignedBigInteger('area_id');

            $table->string('name');

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

        Schema::dropIfExists('housetypes');

    }

}

