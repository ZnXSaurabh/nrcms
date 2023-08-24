<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateAreasTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('areas', function (Blueprint $table) {

            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('division_id');

            $table->unsignedBigInteger('location_id');

            $table->string('name');

            $table->text('description')->nullable();

            $table->timestamps();



            $table->foreign('location_id')->references('id')->on('locations');
            
            $table->foreign('division_id')->references('id')->on('divisions');

        });

    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

        Schema::dropIfExists('areas');

    }

}

