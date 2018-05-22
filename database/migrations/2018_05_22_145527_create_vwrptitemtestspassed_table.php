<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVwrptitemtestspassedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vwrptitemtestspassed', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('ItemID', 65535)->nullable();
			$table->integer('TestLab')->nullable();
			$table->integer('Active')->nullable();
			$table->text('Desc1', 65535)->nullable();
			$table->text('LabName', 65535)->nullable();
			$table->text('StdName', 65535)->nullable();
			$table->text('StdDesc', 65535)->nullable();
			$table->dateTime('TestDate')->nullable();
			$table->text('TestReptPdf', 65535)->nullable();
			$table->text('ReptNo', 65535)->nullable();
			$table->integer('SubstrateLvl')->nullable();
			$table->integer('SurfaceLvl')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vwrptitemtestspassed');
	}

}
