<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPuzzleGamesResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('puzzle_games_results', function(Blueprint $table)
		{
			$table->foreign('player_id', 'puzzle_games_results_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('maze_game_id', 'puzzle_games_results_ibfk_2')->references('id')->on('games')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('maze_game_results_id', 'puzzle_games_results_ibfk_3')->references('id')->on('maze_game_results')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('puzzle_games_results', function(Blueprint $table)
		{
			$table->dropForeign('puzzle_games_results_ibfk_1');
			$table->dropForeign('puzzle_games_results_ibfk_2');
			$table->dropForeign('puzzle_games_results_ibfk_3');
		});
	}

}
