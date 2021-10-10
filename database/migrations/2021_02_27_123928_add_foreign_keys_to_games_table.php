<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('games', function(Blueprint $table)
		{
			$table->foreign('creator_id', 'games_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('XSD_id', 'games_ibfk_2')->references('id')->on('xsdschemas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('learning_content_taxonomy_id', 'games_ibfk_3')->references('id')->on('learning_content_taxonomy')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('games', function(Blueprint $table)
		{
			$table->dropForeign('games_ibfk_1');
			$table->dropForeign('games_ibfk_2');
			$table->dropForeign('games_ibfk_3');
		});
	}

}
