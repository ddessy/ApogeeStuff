<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuizQuestionsAnswersTypeEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quiz_questions_answers_type_entries', function(Blueprint $table)
		{
			$table->foreign('quiz_questions_answers_type_id', 'quiz_questions_answers_type_entries_ibfk_1')->references('id')->on('quiz_questions_answers_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quiz_questions_answers_type_entries', function(Blueprint $table)
		{
			$table->dropForeign('quiz_questions_answers_type_entries_ibfk_1');
		});
	}

}
