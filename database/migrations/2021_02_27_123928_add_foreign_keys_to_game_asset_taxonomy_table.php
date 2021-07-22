<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGameAssetTaxonomyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('game_asset_taxonomy', function(Blueprint $table)
		{
			$table->foreign('parent_id', 'game_asset_taxonomy_ibfk_1')->references('id')->on('game_asset_taxonomy')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('game_asset_taxonomy', function(Blueprint $table)
		{
			$table->dropForeign('game_asset_taxonomy_ibfk_1');
		});
	}

}
