<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocenteAreasTrabalhosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('docente_areas_trabalhos', function(Blueprint $table)
		{
			$table->integer('docente_areas_id')->index('fk_docente_areas_has_trabalhos_docente_areas1_idx');
			$table->integer('trabalhos_id')->index('fk_docente_areas_has_trabalhos_trabalhos1_idx');
			$table->integer('id', true);
			$table->integer('funcoes_id')->index('fk_docente_areas_has_trabalhos_funcoes1_idx');
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
		Schema::drop('docente_areas_trabalhos');
	}

}
