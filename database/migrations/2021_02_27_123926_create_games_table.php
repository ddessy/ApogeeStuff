<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('game_name')->nullable();
			$table->integer('creator_id')->nullable()->index('creator_id');
			$table->dateTime('created_at')->nullable()->default('now()');
			$table->string('game_description')->nullable();
			$table->string('game_body')->nullable();
			$table->string('game_version')->nullable();
			$table->integer('XSD_id')->nullable()->index('XSD_id');
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
		Schema::drop('games');
	}

}
