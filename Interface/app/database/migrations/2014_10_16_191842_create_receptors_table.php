<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('receptors', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("mac",16)->unique();
            $table->string("name");
            $table->integer("types_id");
            $table->integer("coordinators_id");
            $table->integer("locations_id");
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("receptors");
	}

}
