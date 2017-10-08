<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreasSupervisorExternosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areas_supervisor_externos', function(Blueprint $table)
		{
			$table->integer('areas_id')->index('fk_areas_has_supervisor_externos_areas1_idx');
			$table->integer('supervisor_externos_id')->index('fk_areas_has_supervisor_externos_supervisor_externos1_idx');
			$table->integer('id', true);
			$table->softDeletes();
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
		Schema::drop('areas_supervisor_externos');
	}

}
