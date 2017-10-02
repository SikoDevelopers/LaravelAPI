<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocenteAreasTrabalhosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('docente_areas_trabalhos', function(Blueprint $table)
		{
			$table->foreign('docente_areas_id', 'fk_docente_areas_has_trabalhos_docente_areas1')->references('id')->on('docente_areas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('funcoes_id', 'fk_docente_areas_has_trabalhos_funcoes1')->references('id')->on('funcoes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('trabalhos_id', 'fk_docente_areas_has_trabalhos_trabalhos1')->references('id')->on('trabalhos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('docente_areas_trabalhos', function(Blueprint $table)
		{
			$table->dropForeign('fk_docente_areas_has_trabalhos_docente_areas1');
			$table->dropForeign('fk_docente_areas_has_trabalhos_funcoes1');
			$table->dropForeign('fk_docente_areas_has_trabalhos_trabalhos1');
		});
	}

}
