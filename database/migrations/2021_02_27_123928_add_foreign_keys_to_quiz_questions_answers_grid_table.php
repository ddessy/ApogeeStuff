<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuizQuestionsAnswersGridTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quiz_questions_answers_grid', function(Blueprint $table)
		{
			$table->foreign('quiz_question_id', 'quiz_questions_answers_grid_ibfk_1')->references('id')->on('quiz_questions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quiz_questions_answers_grid', function(Blueprint $table)
		{
			$table->dropForeign('quiz_questions_answers_grid_ibfk_1');
		});
	}

}
