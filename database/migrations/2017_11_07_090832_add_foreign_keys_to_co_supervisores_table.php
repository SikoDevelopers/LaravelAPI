<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCoSupervisoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('co_supervisores', function(Blueprint $table)
		{
			$table->foreign('grau_academico_id', 'fk_co_supervisores_grau_academico1')->references('id')->on('grau_academico')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('co_supervisores', function(Blueprint $table)
		{
			$table->dropForeign('fk_co_supervisores_grau_academico1');
		});
	}

}
