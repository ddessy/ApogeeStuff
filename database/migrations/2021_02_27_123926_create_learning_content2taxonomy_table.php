<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningContent2taxonomyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('learning_content2taxonomy', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('learning_content_id')->nullable()->index('learning_content_id');
			$table->integer('learning_content_taxonomy_id')->nullable()->index('learning_content_taxonomy_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('learning_content2taxonomy');
	}

}
