<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsAnswersGridEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_questions_answers_grid_entries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('quiz_question_id')->nullable()->index('quiz_question_id');
			$table->integer('answer_grid_id')->index('answer_grid_id');
			$table->integer('answer_grid_entry_value')->nullable();
			$table->string('answer_grid_entry_name')->nullable();
			$table->string('answer_grid_entry_descr')->nullable();
			$table->integer('entry_student_model_property_id')->nullable()->index('entry_student_model_property_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quiz_questions_answers_grid_entries');
	}

}
