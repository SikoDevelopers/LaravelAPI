<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocenteAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('docente_areas', function(Blueprint $table)
		{
			$table->foreign('areas_id', 'fk_areas_has_docentes_areas1')->references('id')->on('areas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('docentes_id', 'fk_areas_has_docentes_docentes1')->references('id')->on('docentes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('docente_areas', function(Blueprint $table)
		{
			$table->dropForeign('fk_areas_has_docentes_areas1');
			$table->dropForeign('fk_areas_has_docentes_docentes1');
		});
	}

}
