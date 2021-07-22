<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuizQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quiz_questions', function(Blueprint $table)
		{
			$table->foreign('quiz_id', 'quiz_questions_ibfk_1')->references('id')->on('quizzes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('q_type_id', 'quiz_questions_ibfk_2')->references('id')->on('question_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('q_student_model_property_id', 'quiz_questions_ibfk_3')->references('id')->on('student_model_properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quiz_questions', function(Blueprint $table)
		{
			$table->dropForeign('quiz_questions_ibfk_1');
			$table->dropForeign('quiz_questions_ibfk_2');
			$table->dropForeign('quiz_questions_ibfk_3');
		});
	}

}
