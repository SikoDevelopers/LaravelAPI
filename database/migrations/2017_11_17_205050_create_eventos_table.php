<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('data')->nullable();
			$table->string('data_inicio', 45)->nullable();
			$table->string('data_fim', 45)->nullable();
			$table->string('local', 45)->nullable();
			$table->string('hora', 45)->nullable();
			$table->string('agenda', 45)->nullable();
			$table->string('telefone', 45)->nullable();
			$table->string('email', 45)->nullable();
			$table->integer('categorias_eventos_id')->index('fk_eventos_categorias_eventos1_idx');
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
		Schema::drop('eventos');
	}

}
