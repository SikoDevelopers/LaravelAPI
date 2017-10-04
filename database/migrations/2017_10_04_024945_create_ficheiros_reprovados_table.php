<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFicheirosReprovadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ficheiros_reprovados', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('motivo', 45)->nullable();
			$table->string('data_nova_submissao', 45)->nullable();
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
		Schema::drop('ficheiros_reprovados');
	}

}
