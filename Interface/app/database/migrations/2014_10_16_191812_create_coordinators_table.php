<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('coordinators', function(Blueprint $table)
		{
            $table->increments("id");
            $table->string("mac",16)->unique();
            $table->string("name");
            $table->integer("location_id");
            $table->integer("users_id");
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
        Schema::dropIfExists("coordinators");
	}

}
