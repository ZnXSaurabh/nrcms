<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateQuartersTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('quarters', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('division_id');
            
            $table->unsignedBigInteger('location_id');

            $table->unsignedBigInteger('area_id');

            $table->unsignedBigInteger('housetype_id');

            $table->unsignedBigInteger('block_id');

            $table->string('qtrno');

            $table->string('quarter_id');

            $table->string('rent');

            $table->string('house_area');

            $table->string('garages');

            $table->string('status');

            $table->text('remarks')->nullable();

            $table->timestamps();


            $table->foreign('division_id')->references('id')->on('divisions');
            
            $table->foreign('location_id')->references('id')->on('locations');

            $table->foreign('area_id')->references('id')->on('areas');

            $table->foreign('housetype_id')->references('id')->on('housetypes');

            $table->foreign('block_id')->references('id')->on('blocks');

        });

    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

        Schema::dropIfExists('quarters');

    }

}

