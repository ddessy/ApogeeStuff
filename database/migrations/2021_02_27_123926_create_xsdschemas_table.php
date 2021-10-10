<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXsdschemasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('xsdschemas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('xsd_content')->nullable();
			$table->string('xsd_version')->nullable();
			$table->dateTime('created_at')->nullable()->default('now()');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('xsdschemas');
	}

}
