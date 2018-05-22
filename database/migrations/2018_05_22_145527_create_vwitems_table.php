<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVwitemsTable extends Migration {

	/**
	 * Run the migrations./
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vwitems', function(Blueprint $table)
		{
			$table->integer('wdt_ID', true);
			$table->integer('cono')->nullable();
			$table->string('whse')->nullable();
			$table->string('itemid')->nullable();
			$table->string('desc1')->nullable();
			$table->string('desc2')->nullable();
			$table->string('prodcat')->nullable();
			$table->string('catalogyear')->nullable();
			$table->string('factoryno')->nullable();
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
		Schema::drop('vwitems');
	}

}
