<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentModelPropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_model_properties', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('property_name')->nullable();
			$table->string('property_type')->nullable();
			$table->string('property_quantity')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_model_properties');
	}

}
