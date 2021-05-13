<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsAnswersGridTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_questions_answers_grid', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('quiz_question_id')->nullable()->index('quiz_question_id');
			$table->string('answer_grid_name')->nullable();
			$table->string('answer_grid_descr')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quiz_questions_answers_grid');
	}

}
