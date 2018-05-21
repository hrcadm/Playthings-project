<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVwstandardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vwstandards', function(Blueprint $table)
		{
			$table->integer('wdt_ID', true);
			$table->integer('id')->nullable();
			$table->integer('sortsequence')->nullable();
			$table->string('stdname')->nullable();
			$table->string('stddesc')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vwstandards');
	}

}
