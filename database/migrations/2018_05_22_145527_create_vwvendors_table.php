<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVwvendorsTable extends Migration {

	/**
	 * Run the migrations./
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vwvendors', function(Blueprint $table)
		{
			$table->integer('wdt_ID', true);
			$table->integer('cono')->nullable();
			$table->string('vendno')->nullable();
			$table->string('vendname')->nullable();
			$table->integer('vendtype')->nullable();
			$table->string('addr1')->nullable();
			$table->string('addr2')->nullable();
			$table->string('city')->nullable();
			$table->integer('state')->nullable();
			$table->string('zipcd')->nullable();
			$table->string('phoneno')->nullable();
			$table->integer('apcustno')->nullable();
			$table->string('ssmatimestamp')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vwvendors');
	}

}
