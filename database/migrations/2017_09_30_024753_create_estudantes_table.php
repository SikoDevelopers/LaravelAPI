<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstudantesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estudantes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('apelido', 45)->nullable();
			$table->string('nome', 45)->nullable();
			$table->string('data_nascimento', 45)->nullable();
			$table->string('morada', 45)->nullable();
			$table->string('sessao', 45)->nullable();
			$table->integer('cursos_id')->index('fk_estudantes_cursos1_idx');
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
		Schema::drop('estudantes');
	}

}
