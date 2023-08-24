<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateSubCategoriesTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('sub_categories', function (Blueprint $table) {

            $table->bigIncrements('id');
            
            $table->string('division_id');

            $table->unsignedBigInteger('category_id');

            $table->string('icons')->nullable();

            $table->string('name');

            $table->text('description')->nullable();

            $table->timestamps();


            // $table->foreign('division_id')->references('id')->on('divisions');
            
            $table->foreign('category_id')->references('id')->on('categories');

        });

    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

        Schema::dropIfExists('sub_categories');

    }

}

