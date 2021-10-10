<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLearningStylesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('learning_styles', function(Blueprint $table)
		{
			$table->foreign('student_id', 'learning_styles_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('style1_name_id', 'learning_styles_ibfk_2')->references('id')->on('student_model_properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('style2_name_id', 'learning_styles_ibfk_3')->references('id')->on('student_model_properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('style3_name_id', 'learning_styles_ibfk_4')->references('id')->on('student_model_properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('style4_name_id', 'learning_styles_ibfk_5')->references('id')->on('student_model_properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('learning_styles', function(Blueprint $table)
		{
			$table->dropForeign('learning_styles_ibfk_1');
			$table->dropForeign('learning_styles_ibfk_2');
			$table->dropForeign('learning_styles_ibfk_3');
			$table->dropForeign('learning_styles_ibfk_4');
			$table->dropForeign('learning_styles_ibfk_5');
		});
	}

}
