<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocentesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('docentes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('apelido', 45)->nullable();
			$table->string('nome', 45)->nullable();
			$table->string('sessao', 45)->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->integer('users_id')->index('fk_docentes_users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('docentes');
	}

}
