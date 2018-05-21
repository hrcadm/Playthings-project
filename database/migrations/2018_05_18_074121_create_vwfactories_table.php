<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVwfactoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vwfactories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('factno')->nullable();
			$table->string('vendorno')->nullable();
			$table->string('factname')->nullable();
			$table->string('factaddr1')->nullable();
			$table->string('factaddr2')->nullable();
			$table->string('factcity')->nullable();
			$table->string('factdistrict')->nullable();
			$table->string('factstate')->nullable();
			$table->string('factcountry')->nullable();
			$table->integer('factpostalcd')->nullable();
			$table->string('factphone')->nullable();
			$table->string('factfax')->nullable();
			$table->string('factemail')->nullable();
			$table->integer('factwebsite')->nullable();
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
		Schema::drop('vwfactories');
	}

}
