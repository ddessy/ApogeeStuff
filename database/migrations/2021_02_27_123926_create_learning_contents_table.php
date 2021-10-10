<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('learning_contents', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('content_name')->nullable();
			$table->string('content_description')->nullable();
			$table->binary('content_body', 65535)->nullable();
			$table->string('content_presentation_style')->nullable();
			$table->string('content_complexity_level')->nullable();
			$table->string('content_status')->nullable();
			$table->integer('ipr_id')->nullable()->index('ipr_id');
			$table->integer('file_ext_id')->nullable()->index('file_ext_id');
			$table->integer('file_size_kb')->nullable();
			$table->string('author_name')->nullable();
			$table->integer('creator_id')->nullable()->index('creator_id');
			$table->dateTime('created_at')->nullable()->default('now()');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('learning_contents');
	}

}
