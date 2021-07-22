<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuizQuestionsAnswersGridEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quiz_questions_answers_grid_entries', function(Blueprint $table)
		{
			$table->foreign('quiz_question_id', 'quiz_questions_answers_grid_entries_ibfk_1')->references('id')->on('quiz_questions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('answer_grid_id', 'quiz_questions_answers_grid_entries_ibfk_2')->references('id')->on('quiz_questions_answers_grid')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('entry_student_model_property_id', 'quiz_questions_answers_grid_entries_ibfk_3')->references('id')->on('student_model_properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quiz_questions_answers_grid_entries', function(Blueprint $table)
		{
			$table->dropForeign('quiz_questions_answers_grid_entries_ibfk_1');
			$table->dropForeign('quiz_questions_answers_grid_entries_ibfk_2');
			$table->dropForeign('quiz_questions_answers_grid_entries_ibfk_3');
		});
	}

}
