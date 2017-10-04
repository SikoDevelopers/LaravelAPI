<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrabalhosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trabalhos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('titulo', 45)->nullable();
			$table->string('descricao', 200)->nullable();
			$table->integer('estudantes_id')->index('fk_trabalhos_estudantes1_idx');
			$table->integer('eventos_id')->nullable()->index('fk_trabalhos_eventos1_idx');
			$table->boolean('is_aprovado')->nullable();
			$table->softDeletes();
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
		Schema::drop('trabalhos');
	}

}
