<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDirectoresCursosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('directores_cursos', function(Blueprint $table)
		{
			$table->foreign('cursos_id', 'fk_directores_curso_cursos1')->references('id')->on('cursos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('users_id', 'fk_directores_cursos_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('directores_cursos', function(Blueprint $table)
		{
			$table->dropForeign('fk_directores_curso_cursos1');
			$table->dropForeign('fk_directores_cursos_users1');
		});
	}

}
