<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTrabalhosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trabalhos', function(Blueprint $table)
		{
			$table->foreign('estudantes_id', 'fk_trabalhos_estudantes1')->references('id')->on('estudantes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('eventos_id', 'fk_trabalhos_eventos1')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('trabalhos', function(Blueprint $table)
		{
			$table->dropForeign('fk_trabalhos_estudantes1');
			$table->dropForeign('fk_trabalhos_eventos1');
		});
	}

}
