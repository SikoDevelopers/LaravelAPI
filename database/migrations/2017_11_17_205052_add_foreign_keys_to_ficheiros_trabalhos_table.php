<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFicheirosTrabalhosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ficheiros_trabalhos', function(Blueprint $table)
		{
			$table->foreign('categorias_ficheiros_id', 'fk_categorias_ficheiros')->references('id')->on('categorias_ficheiros')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('avaliacoes_id', 'fk_ficheiros_trabalhos_avaliacoes1')->references('id')->on('avaliacoes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('trabalhos_id', 'fk_ficheiros_trabalhos_trabalhos1')->references('id')->on('trabalhos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ficheiros_trabalhos', function(Blueprint $table)
		{
			$table->dropForeign('fk_categorias_ficheiros');
			$table->dropForeign('fk_ficheiros_trabalhos_avaliacoes1');
			$table->dropForeign('fk_ficheiros_trabalhos_trabalhos1');
		});
	}

}
