<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFunUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fun_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('apelido', 45);
			$table->string('nome', 45);
			$table->string('username', 45);
			$table->string('senha', 45);
			$table->string('nivel_acesso', 45)->nullable();
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
		Schema::drop('fun_users');
	}

}
