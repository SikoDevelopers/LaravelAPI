<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEstudantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('estudantes', function(Blueprint $table)
		{
			$table->foreign('cursos_id', 'fk_estudantes_cursos1')->references('id')->on('cursos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('estudantes', function(Blueprint $table)
		{
			$table->dropForeign('fk_estudantes_cursos1');
		});
	}

}
