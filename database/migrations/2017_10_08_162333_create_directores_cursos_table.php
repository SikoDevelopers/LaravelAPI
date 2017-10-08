<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectoresCursosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('directores_cursos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('apelido', 45)->nullable();
			$table->string('nome', 45)->nullable();
			$table->integer('cursos_id')->index('fk_directores_curso_cursos1_idx');
			$table->softDeletes();
			$table->timestamps();
			$table->integer('users_id')->index('fk_directores_cursos_users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('directores_cursos');
	}

}
