<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningContentTaxonomyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('learning_content_taxonomy', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('learning_concept_name')->nullable();
			$table->integer('parent_id')->nullable()->index('parent_id');
			$table->dateTime('created_at')->nullable()->default('now()');
			$table->string('learning_concept_description')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('learning_content_taxonomy');
	}

}
