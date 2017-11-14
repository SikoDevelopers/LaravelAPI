<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvaliacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avaliacoes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('parecer', 45)->nullable();
			$table->timestamp('data_limite')->nullable();
			$table->timestamp('data')->nullable();
			$table->integer('docentes_id')->index('fk_avaliacoes_docentes1_idx');
			$table->string('fase', 45)->nullable();
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
		Schema::drop('avaliacoes');
	}

}
