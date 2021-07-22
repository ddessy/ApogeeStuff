<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntellectualPropRightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('intellectual_prop_rights', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('ipr_name')->nullable();
			$table->string('ipr_descr')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('intellectual_prop_rights');
	}

}
