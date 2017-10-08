<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSupervisorExternosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('supervisor_externos', function(Blueprint $table)
		{
			$table->foreign('users_id', 'fk_supervisor_externos_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('supervisor_externos', function(Blueprint $table)
		{
			$table->dropForeign('fk_supervisor_externos_users1');
		});
	}

}
