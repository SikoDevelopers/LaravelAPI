<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProcessoSubmissaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('processo_submissao', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->softDeletes();
			$table->timestamps();
			$table->dateTime('data_inicio');
			$table->dateTime('data_fim');
			$table->string('tipo_processo', 191);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('processo_submissao');
	}

}
