<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTemasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('temas', function(Blueprint $table)
		{
			$table->foreign('areas_id', 'fk_temas_areas1')->references('id')->on('areas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('docentes_id', 'fk_temas_docentes1')->references('id')->on('docentes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('temas', function(Blueprint $table)
		{
			$table->dropForeign('fk_temas_areas1');
			$table->dropForeign('fk_temas_docentes1');
		});
	}

}
