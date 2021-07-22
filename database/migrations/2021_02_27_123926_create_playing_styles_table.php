<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayingStylesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('playing_styles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('student_id')->nullable()->index('student_id');
			$table->integer('style1_name_id')->nullable()->index('style1_name_id');
			$table->integer('style1_value')->nullable();
			$table->integer('style2_name_id')->nullable()->index('style2_name_id');
			$table->integer('style2_value')->nullable();
			$table->integer('style3_name_id')->nullable()->index('style3_name_id');
			$table->integer('style3_value')->nullable();
			$table->integer('style4_name_id')->nullable()->index('style4_name_id');
			$table->integer('style4_value')->nullable();
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
		Schema::drop('playing_styles');
	}

}
