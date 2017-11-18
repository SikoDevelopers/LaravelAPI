<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFicheirosTrabalhosEstadosFicheirosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ficheiros_trabalhos_estados_ficheiros', function(Blueprint $table)
		{
			$table->integer('ficheiros_trabalhos_id')->index('fk_estados_ficheiros_ficheiros_trab_idx');
			$table->integer('estados_ficheiros_id')->index('fk_estados_ficheiros_estados_fichei_idx');
			$table->string('data', 45)->nullable();
			$table->boolean('is_actual')->nullable();
			$table->integer('id', true);
			$table->softDeletes();
			$table->timestamps();
			$table->string('parecer', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ficheiros_trabalhos_estados_ficheiros');
	}

}
