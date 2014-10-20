<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('locations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string("name");
            $table->string("latitude")->nullable()->default(null);
            $table->string("longitude")->nullable()->default(null);
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
		Schema::dropIfExists("locations");
	}

}
