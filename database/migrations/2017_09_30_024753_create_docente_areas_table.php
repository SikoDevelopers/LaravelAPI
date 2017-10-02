<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocenteAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('docente_areas', function(Blueprint $table)
		{
			$table->integer('areas_id')->index('fk_areas_has_docentes_areas1_idx');
			$table->integer('docentes_id')->index('fk_areas_has_docentes_docentes1_idx');
			$table->integer('id', true);
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
		Schema::drop('docente_areas');
	}

}
