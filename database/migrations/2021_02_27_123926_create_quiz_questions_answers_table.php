<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_questions_answers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('quiz_question_id')->nullable()->index('quiz_question_id');
			$table->integer('quiz_questions_answers_type_id')->nullable()->index('quiz_questions_answers_type_id');
			$table->integer('answer_grid_id')->nullable()->index('answer_grid_id');
			$table->string('answer_descr')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quiz_questions_answers');
	}

}
