<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOtherStudentDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('other_student_data', function(Blueprint $table)
		{
			$table->foreign('student_id', 'other_student_data_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('property_id', 'other_student_data_ibfk_2')->references('id')->on('student_model_properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('other_student_data', function(Blueprint $table)
		{
			$table->dropForeign('other_student_data_ibfk_1');
			$table->dropForeign('other_student_data_ibfk_2');
		});
	}

}
