<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateLocationUserTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('location_user', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('division_id');
            
            $table->unsignedBigInteger('area_id');

            $table->unsignedBigInteger('location_id');

            $table->unsignedBigInteger('user_id');

            $table->timestamps();


            $table->foreign('division_id')->references('id')->on('divisions');
            
            $table->foreign('area_id')->references('id')->on('areas');

            $table->foreign('location_id')->references('id')->on('locations');

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

        Schema::dropIfExists('location_user');

    }

}

