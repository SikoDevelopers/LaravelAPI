<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTrabalhosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trabalhos', function(Blueprint $table)
		{
			$table->foreign('areas_supervisor_externos_id', 'fk_trabalhos_areas_supervisor_externos1')->references('id')->on('areas_supervisor_externos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('co_supervisores_id', 'fk_trabalhos_co_supervisores1')->references('id')->on('co_supervisores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('estudantes_id', 'fk_trabalhos_estudantes1')->references('id')->on('estudantes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('eventos_id', 'fk_trabalhos_eventos1')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('trabalhos', function(Blueprint $table)
		{
			$table->dropForeign('fk_trabalhos_areas_supervisor_externos1');
			$table->dropForeign('fk_trabalhos_co_supervisores1');
			$table->dropForeign('fk_trabalhos_estudantes1');
			$table->dropForeign('fk_trabalhos_eventos1');
		});
	}

}
