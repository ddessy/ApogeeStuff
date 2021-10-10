<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsResponsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_questions_responses', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('respondent_id')->nullable()->index('respondent_id');
			$table->integer('quiz_question_id')->nullable()->index('quiz_question_id');
			$table->string('response_text')->nullable();
			$table->integer('answer_type_id')->nullable()->index('answer_type_id');
			$table->integer('answer_grid_entry_id')->nullable()->index('answer_grid_entry_id');
			$table->dateTime('registered_at')->nullable()->default('now()');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quiz_questions_responses');
	}

}
