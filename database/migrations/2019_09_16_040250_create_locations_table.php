<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateLocationsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('locations', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('division_id');

            $table->string('name');

            $table->text('description')->nullable();

            $table->boolean('isActive')->default(0);

            $table->timestamps();


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

        Schema::dropIfExists('locations');

    }

}

