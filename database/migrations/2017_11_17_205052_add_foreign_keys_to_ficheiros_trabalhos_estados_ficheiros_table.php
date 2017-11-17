<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFicheirosTrabalhosEstadosFicheirosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ficheiros_trabalhos_estados_ficheiros', function(Blueprint $table)
		{
			$table->foreign('ficheiros_trabalhos_id', 'fk_estados_ficheiros_ficheiros_trabal1')->references('id')->on('ficheiros_trabalhos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('estados_ficheiros_id', 'fk_ficheiros_estados_ficheiros1')->references('id')->on('estados_ficheiros')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ficheiros_trabalhos_estados_ficheiros', function(Blueprint $table)
		{
			$table->dropForeign('fk_estados_ficheiros_ficheiros_trabal1');
			$table->dropForeign('fk_ficheiros_estados_ficheiros1');
		});
	}

}
