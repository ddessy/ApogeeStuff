<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsAnswersTypeEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_questions_answers_type_entries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('quiz_questions_answers_type_id')->nullable()->index('quiz_questions_answers_type_id');
			$table->string('answer_name')->nullable();
			$table->integer('answer_value')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quiz_questions_answers_type_entries');
	}

}
