<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateVendorsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('vendors', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('division_id');

            $table->unsignedBigInteger('location_id');

            $table->unsignedBigInteger('area_id')->nullable();

            $table->string('name');

            $table->string('email')->unique()->nullable();

            $table->string('mobile')->unique();

            $table->string('agreement_no');

            $table->string('photo')->nullable();

            $table->text('remarks')->nullable();

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

        Schema::dropIfExists('vendors');

    }

}

