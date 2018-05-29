<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalItemTestRecordsFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vwrptitemtestspassed', function (Blueprint $table) {
            $table->integer('factId')->nullable()->default(null);
            $table->string('poNumber')->nullable()->default(null);
        });
    }

    public function down()
    {
        Schema::table('vwrptitemtestspassed', function($table) {
            $table->dropColumn('factId');
            $table->dropColumn('poNumber');
        });
    }
}
