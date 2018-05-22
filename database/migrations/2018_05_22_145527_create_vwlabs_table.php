<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVwlabsTable extends Migration {

	/**
	 * Run the migrations./
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vwlabs', function(Blueprint $table)
		{
			$table->integer('wdt_ID', true);
			$table->integer('id')->nullable();
			$table->string('labname')->nullable();
			$table->string('labaddr1')->nullable();
			$table->string('labaddr2')->nullable();
			$table->string('labcity')->nullable();
			$table->string('labdistrict')->nullable();
			$table->string('labstate')->nullable();
			$table->string('labcountry')->nullable();
			$table->string('labpostalcode')->nullable();
			$table->string('labphone')->nullable();
			$table->string('labfax')->nullable();
			$table->string('labemail', 2000)->nullable();
			$table->string('labwebsite', 2000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vwlabs');
	}

}
