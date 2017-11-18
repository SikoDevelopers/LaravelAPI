<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFicheirosTrabalhosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ficheiros_trabalhos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('caminho', 45)->nullable();
			$table->date('data')->nullable();
			$table->integer('categorias_ficheiros_id')->index('fk_categorias_ficheiros_idx');
			$table->integer('trabalhos_id')->index('fk_ficheiros_trabalhos_trabalhos1_idx');
			$table->integer('ficheiros_reprovados_id')->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->integer('avaliacoes_id')->nullable()->index('fk_ficheiros_trabalhos_avaliacoes1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ficheiros_trabalhos');
	}

}
