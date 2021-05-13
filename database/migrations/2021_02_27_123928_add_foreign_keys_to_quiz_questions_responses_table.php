<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuizQuestionsResponsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quiz_questions_responses', function(Blueprint $table)
		{
			$table->foreign('respondent_id', 'quiz_questions_responses_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('quiz_question_id', 'quiz_questions_responses_ibfk_2')->references('id')->on('quiz_questions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('answer_type_id', 'quiz_questions_responses_ibfk_3')->references('id')->on('quiz_questions_answers_type_entries')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('answer_grid_entry_id', 'quiz_questions_responses_ibfk_4')->references('id')->on('quiz_questions_answers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quiz_questions_responses', function(Blueprint $table)
		{
			$table->dropForeign('quiz_questions_responses_ibfk_1');
			$table->dropForeign('quiz_questions_responses_ibfk_2');
			$table->dropForeign('quiz_questions_responses_ibfk_3');
			$table->dropForeign('quiz_questions_responses_ibfk_4');
		});
	}

}
