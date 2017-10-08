<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAreasSupervisorExternosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('areas_supervisor_externos', function(Blueprint $table)
		{
			$table->foreign('areas_id', 'fk_areas_has_supervisor_externos_areas1')->references('id')->on('areas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('supervisor_externos_id', 'fk_areas_has_supervisor_externos_supervisor_externos1')->references('id')->on('supervisor_externos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('areas_supervisor_externos', function(Blueprint $table)
		{
			$table->dropForeign('fk_areas_has_supervisor_externos_areas1');
			$table->dropForeign('fk_areas_has_supervisor_externos_supervisor_externos1');
		});
	}

}
