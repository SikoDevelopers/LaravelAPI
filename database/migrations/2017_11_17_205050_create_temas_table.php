<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('temas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('designacao', 45)->nullable();
			$table->integer('docentes_id')->index('fk_temas_docentes1_idx');
			$table->integer('areas_id')->index('fk_temas_areas1_idx');
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
		Schema::drop('temas');
	}

}
