<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMazeGameResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maze_game_results', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('player_id')->nullable()->index('player_id');
			$table->integer('maze_game_id')->nullable()->index('maze_game_id');
			$table->integer('total_playing_time')->nullable();
			$table->integer('total_points')->nullable();
			$table->float('total_game_goals_exec', 10, 0)->nullable();
			$table->float('general_score', 10, 0)->nullable();
			$table->float('general_effectiveness', 10, 0)->nullable();
			$table->float('general_efficiency', 10, 0)->nullable();
			$table->dateTime('registered_at')->nullable()->default('now()');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('maze_game_results');
	}

}
