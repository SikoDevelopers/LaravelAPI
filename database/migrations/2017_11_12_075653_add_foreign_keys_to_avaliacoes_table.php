<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAvaliacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('avaliacoes', function(Blueprint $table)
		{
			$table->foreign('docentes_id', 'fk_avaliacoes_docentes1')->references('id')->on('docentes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('avaliacoes', function(Blueprint $table)
		{
			$table->dropForeign('fk_avaliacoes_docentes1');
		});
	}

}
