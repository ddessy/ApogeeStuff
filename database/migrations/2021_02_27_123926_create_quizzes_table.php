<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quizzes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('creator_id')->nullable()->index('creator_id');
			$table->string('quiz_name')->nullable();
			$table->string('quiz_descr', 1024)->nullable();
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
		Schema::drop('quizzes');
	}

}
