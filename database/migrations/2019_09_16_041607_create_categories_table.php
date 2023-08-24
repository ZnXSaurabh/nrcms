<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateCategoriesTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('categories', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('division_id');
            
            $table->unsignedBigInteger('sup_cat_id');

            $table->string('name');

            $table->string('icons')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();


            // $table->foreign('division_id')->references('id')->on('divisions');

            $table->foreign('sup_cat_id')->references('id')->on('super_categories');

        });

    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

        Schema::dropIfExists('categories');

    }

}

