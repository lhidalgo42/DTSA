<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('sensors', function(Blueprint $table)
		{
			$table->increments("id");
            $table->string("name");
            $table->integer("python_name")->nullable()->default(null);
            $table->tinyInteger("control");
            $table->integer("locations_id");
            $table->integer("receptors_id");
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
		Schema::dropIfExists("sensors");
	}

}
