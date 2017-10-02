<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventosEstadoEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eventos_estado_eventos', function(Blueprint $table)
		{
			$table->foreign('estado_eventos_id', 'fk_estado_eventos_has_eventos_estado_eventos1')->references('id')->on('estados_eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('eventos_id', 'fk_estado_eventos_has_eventos_eventos1')->references('id')->on('eventos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eventos_estado_eventos', function(Blueprint $table)
		{
			$table->dropForeign('fk_estado_eventos_has_eventos_estado_eventos1');
			$table->dropForeign('fk_estado_eventos_has_eventos_eventos1');
		});
	}

}
