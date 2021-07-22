<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuzzleGamesResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('puzzle_games_results', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('player_id')->nullable()->index('player_id');
			$table->integer('maze_game_id')->nullable()->index('maze_game_id');
			$table->integer('maze_game_results_id')->nullable()->index('maze_game_results_id');
			$table->string('puzzle_game_name')->nullable();
			$table->integer('playing_time')->nullable();
			$table->integer('points')->nullable();
			$table->float('grade', 10, 0)->nullable();
			$table->float('game_goals_exec', 10, 0)->nullable();
			$table->float('general_score', 10, 0)->nullable();
			$table->float('efficiency', 10, 0)->nullable();
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
		Schema::drop('puzzle_games_results');
	}

}
