<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventosEstadoEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos_estado_eventos', function(Blueprint $table)
		{
			$table->integer('estado_eventos_id')->index('fk_estado_eventos_has_eventos_estado_eventos1_idx');
			$table->integer('eventos_id')->index('fk_estado_eventos_has_eventos_eventos1_idx');
			$table->integer('id', true);
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
		Schema::drop('eventos_estado_eventos');
	}

}
