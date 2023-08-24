<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateSuperCategoriesTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('super_categories', function (Blueprint $table) {

            $table->bigIncrements('id');
            
            $table->string('division_id');
            
            $table->string('name');

            $table->string('icons')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();


            // $table->foreign('division_id')->references('id')->on('divisions');
            
        });

    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

        Schema::dropIfExists('super_categories');

    }

}

