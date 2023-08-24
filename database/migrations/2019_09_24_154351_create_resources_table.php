<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateResourcesTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('resources', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('division_id');
            
            $table->unsignedBigInteger('location_id');
            
            $table->unsignedBigInteger('vendor_id');

            $table->string('name');

            $table->string('email')->unique()->nullable();

            $table->string('mobile')->unique();

            $table->string('address');

            $table->string('pfno')->unique()->nullable();

            $table->string('esi_no')->nullable();

            $table->unsignedBigInteger('sup_cat_id');

            $table->unsignedBigInteger('category_id');

            $table->unsignedBigInteger('sub_category_id');

            $table->string('photo')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();


            $table->foreign('division_id')->references('id')->on('divisions');
            
            $table->foreign('location_id')->references('id')->on('locations');

            $table->foreign('vendor_id')->references('id')->on('vendors');

            $table->foreign('sup_cat_id')->references('id')->on('super_categories');
            
            $table->foreign('category_id')->references('id')->on('categories');
            
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');

        });

    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

        Schema::dropIfExists('resources');

    }

}

