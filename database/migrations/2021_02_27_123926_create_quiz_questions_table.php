<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quiz_questions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('quiz_id')->nullable()->index('quiz_id');
			$table->integer('q_type_id')->nullable()->index('q_type_id');
			$table->string('q_name', 4096)->nullable();
			$table->string('q_descr', 1024)->nullable();
			$table->integer('q_student_model_property_id')->nullable()->index('q_student_model_property_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quiz_questions');
	}

}
