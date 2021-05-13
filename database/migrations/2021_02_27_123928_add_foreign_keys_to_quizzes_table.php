<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuizzesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quizzes', function(Blueprint $table)
		{
			$table->foreign('creator_id', 'quizzes_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quizzes', function(Blueprint $table)
		{
			$table->dropForeign('quizzes_ibfk_1');
		});
	}

}
