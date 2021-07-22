<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMazeGameResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('maze_game_results', function(Blueprint $table)
		{
			$table->foreign('player_id', 'maze_game_results_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('maze_game_id', 'maze_game_results_ibfk_2')->references('id')->on('games')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('maze_game_results', function(Blueprint $table)
		{
			$table->dropForeign('maze_game_results_ibfk_1');
			$table->dropForeign('maze_game_results_ibfk_2');
		});
	}

}
